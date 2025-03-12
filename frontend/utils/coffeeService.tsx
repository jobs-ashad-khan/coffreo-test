import { CoffeeDTO } from "@/types/CoffeeDTO";
import {CoffeeOrderDTO} from "@/types/CoffeeOrderDTO";
import {CoffeeTypeDTO} from "@/types/CoffeeTypeDTO";
import {CoffeeIntensityDTO} from "@/types/CoffeeIntensityDTO";
import {CoffeeSizeDTO} from "@/types/CoffeeSizeDTO";

const API_URL = process.env.NEXT_PUBLIC_API_URL;

/**
 * Récupère toutes les types de café depuis l'API Symfony.
 */
export const getCoffeeTypes = async (): Promise<CoffeeTypeDTO[]> => {
    const response = await fetch(`${API_URL}/coffee-types`);

    if (!response.ok) {
        throw new Error("Erreur lors de la récupération des types de café");
    }

    return response.json();
};

/**
 * Récupère toutes les intensités de café depuis l'API Symfony.
 */
export const getCoffeeIntensities = async (): Promise<CoffeeIntensityDTO[]> => {
    const response = await fetch(`${API_URL}/coffee-intensities`);

    if (!response.ok) {
        throw new Error("Erreur lors de la récupération des types de café");
    }

    return response.json();
};

/**
 * Récupère toutes les tailles de café depuis l'API Symfony.
 */
export const getCoffeeSizes = async (): Promise<CoffeeSizeDTO[]> => {
    const response = await fetch(`${API_URL}/coffee-sizes`);

    if (!response.ok) {
        throw new Error("Erreur lors de la récupération des types de café");
    }

    return response.json();
};