import { CoffeeDTO } from "@/types/CoffeeDTO";
import {CoffeeOrderDTO} from "@/types/CoffeeOrderDTO";

const API_URL = process.env.NEXT_PUBLIC_API_URL;

/**
 * Envoie d'une commande de café à l'API Symfony
 */
export const createCoffeeOrder = async (coffee: CoffeeDTO): Promise<CoffeeOrderDTO> => {
    const response = await fetch(`${API_URL}/coffee-orders`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(coffee),
    });

    if (!response.ok) {
        throw new Error("Erreur lors de la création de la commande");
    }

    return response.json();
};

/**
 * Récupère toutes les commandes de café depuis l'API Symfony.
 */
export const getCoffeeOrders = async (): Promise<CoffeeOrderDTO[]> => {
    const response = await fetch(`${API_URL}/coffee-orders`);

    if (!response.ok) {
        throw new Error("Erreur lors de la récupération des commandes de café");
    }

    return response.json();
};