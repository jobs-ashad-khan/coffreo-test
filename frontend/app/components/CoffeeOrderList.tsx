"use client";

import {CoffeeOrderDTO} from "@/types/CoffeeOrderDTO";

interface CoffeeOrderListProps {
    coffeeOrders: CoffeeOrderDTO[];
}

export default function CoffeeOrderList({ coffeeOrders }: CoffeeOrderListProps) {
    return (
        <div className="p-4 bg-gray-100 shadow-md rounded-md mt-4">
            <h2 className="text-lg font-semibold mb-3">Commandes en cours</h2>

            <ul className="space-y-2">
                {coffeeOrders.length === 0 ? (
                    <p className="text-gray-500">Aucune commande en cours...</p>
                ) : (
                    coffeeOrders.map((coffeeOrder) => (
                        <li key={coffeeOrder.id} className="p-2 border rounded bg-white">
                            ☕ {coffeeOrder.coffee.type} - <strong>{coffeeOrder.status}</strong>
                        </li>
                    ))
                )}
            </ul>
        </div>
    );
}
