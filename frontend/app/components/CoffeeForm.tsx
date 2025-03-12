"use client";

import React, {useEffect, useState} from "react";
import {CoffeeDTO} from "@/types/CoffeeDTO";
import {createCoffeeOrder} from "@/utils/coffeeOrderService";
import {CoffeeOrderDTO} from "@/types/CoffeeOrderDTO";
import {getCoffeeIntensities, getCoffeeSizes, getCoffeeTypes} from "@/utils/coffeeService";
import {CoffeeTypeDTO} from "@/types/CoffeeTypeDTO";
import {CoffeeIntensityDTO} from "@/types/CoffeeIntensityDTO";
import {CoffeeSizeDTO} from "@/types/CoffeeSizeDTO";
import {coffeeSizeEnumFromString, coffeeSizeLabelsFromEnum} from "@/types/CoffeeSizeEnum";

interface CoffeeFormProps {
    onCoffeeOrder: (coffee: CoffeeOrderDTO) => void;
}

export default function CoffeeForm({ onCoffeeOrder }: CoffeeFormProps) {
    const [coffeeTypes, setCoffeeTypes] = useState<CoffeeTypeDTO[]>([]);
    const [coffeeIntensities, setCoffeeIntensities] = useState<CoffeeIntensityDTO[]>([]);
    const [coffeeSizes, setCoffeeSizes] = useState<CoffeeSizeDTO[]>([]);

    const [coffee, setCoffee] = useState<CoffeeDTO>({
        id: null,
        type: "",
        intensity: -1,
        size: ""
    });

    // Charger les commandes au montage du composant
    useEffect(() => {
        const loadCoffeeOptions = async () => {
            try {
                const [fetchedTypes, fetchedIntensities, fetchedSizes] = await Promise.all([
                    getCoffeeTypes(),
                    getCoffeeIntensities(),
                    getCoffeeSizes(),
                ]);

                setCoffeeTypes(fetchedTypes);
                setCoffeeIntensities(fetchedIntensities);
                setCoffeeSizes(fetchedSizes);

                setCoffee({
                    id: null,
                    type: fetchedTypes.length > 0 ? fetchedTypes[0].type : "",
                    intensity: fetchedIntensities.length > 0 ? Number(fetchedIntensities[0].intensity) : -1,
                    size: fetchedSizes.length > 0 ? fetchedSizes[0].size : "",
                });
            } catch (error) {
                console.error("Erreur lors du chargement des options de café :", error);
            }
        };

        loadCoffeeOptions();
    }, []);

    const handleChange = (e: React.ChangeEvent<HTMLSelectElement>) => {
        const { name, value } = e.target;
        console.log(value);
        setCoffee({ ...coffee, [name]: name === "intensity" ? parseInt(value) : value });
    };

    const handleSubmit = async () => {
        try {
            const newCoffeeOrder = await createCoffeeOrder(coffee);
            onCoffeeOrder(newCoffeeOrder);
        } catch (error) {
            console.error("Erreur lors de l'envoi de la commande :", error);
        }
    };

    return (
        <div className="p-4 bg-white shadow-md rounded-md">
            <h2 className="text-lg font-semibold mb-3">Commander un café</h2>

            <div className="space-y-3">
                <label className="block">
                    Type :
                    <select name="type" value={coffee.type} onChange={handleChange} className="w-full p-2 border rounded">
                        {
                            (
                                coffeeTypes.map((coffeeType) => (
                                    <option key={coffeeType.id} value={coffeeType.type}>{coffeeType.type}</option>
                                ))
                            )
                        }
                    </select>
                </label>

                <label className="block">
                    Intensité :
                    <select name="intensity" value={coffee.intensity} onChange={handleChange} className="w-full p-2 border rounded">
                        {
                            (
                                coffeeIntensities.map((coffeeIntensity) => (
                                    <option key={coffeeIntensity.id} value={coffeeIntensity.intensity}>{coffeeIntensity.intensity}</option>
                                ))
                            )
                        }
                    </select>
                </label>

                <label className="block">
                    Taille :
                    <select name="size" value={coffee.size} onChange={handleChange} className="w-full p-2 border rounded">
                        {
                            (
                                coffeeSizes.map((coffeeSize) => {
                                    let coffeeSizeEnum = coffeeSizeEnumFromString[coffeeSize.size];
                                    return <option key={coffeeSize.id} value={coffeeSize.size}>{coffeeSizeLabelsFromEnum[coffeeSizeEnum]}</option>
                                })
                            )
                        }
                    </select>
                </label>

                <button onClick={handleSubmit} className="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">
                    Commander
                </button>
            </div>
        </div>
    );
}
