"use client";

import React, { useState } from "react";
import {CoffeeDTO} from "@/types/CoffeeDTO";
import {createCoffeeOrder} from "@/utils/coffeeOrderService";
import {CoffeeOrderDTO} from "@/types/CoffeeOrderDTO";

interface CoffeeFormProps {
    onCoffeeOrder: (coffee: CoffeeOrderDTO) => void;
}

export default function CoffeeForm({ onCoffeeOrder }: CoffeeFormProps) {
    const [coffee, setCoffee] = useState<CoffeeDTO>({
        id: null,
        type: "",
        intensity: 3,
        size: "MEDIUM"
    });

    const handleChange = (e: React.ChangeEvent<HTMLSelectElement>) => {
        console.log(e.target.value);
        setCoffee({ ...coffee, [e.target.name]: e.target.value });
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
                        <option>Nespresso</option>
                        <option>Cappuccino</option>
                    </select>
                </label>

                <label className="block">
                    Intensité :
                    <select name="intensity" value={coffee.intensity} onChange={handleChange} className="w-full p-2 border rounded">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </label>

                <label className="block">
                    Taille :
                    <select name="size" value={coffee.size} onChange={handleChange} className="w-full p-2 border rounded">
                        <option value="SMALL">Petite</option>
                        <option value="MEDIUM">Moyenne</option>
                        <option value="LARGE">Grande</option>
                    </select>
                </label>

                <button onClick={handleSubmit} className="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">
                    Commander
                </button>
            </div>
        </div>
    );
}
