"use client";

import {useEffect, useState} from "react";
import {CoffeeOrderDTO} from "@/types/CoffeeOrderDTO";
import CoffeeForm from "@/app/components/CoffeeForm";
import {getCoffeeOrders} from "@/utils/coffeeOrderService";
import CoffeeOrderList from "@/app/components/CoffeeOrderList";

export default function Home() {
  const [coffeeOrders, setCoffeeOrders] = useState<CoffeeOrderDTO[]>([]);

  // Charger les commandes au montage du composant
  useEffect(() => {
    const loadCoffeeOrders = async () => {
      try {
        const fetchedOrders = await getCoffeeOrders();
        setCoffeeOrders(fetchedOrders);
      } catch (error) {
        console.error("Erreur lors du chargement des commandes :", error);
      }
    };

    loadCoffeeOrders();
  }, []);

  const handleNewCoffeeOrder = async (newCoffeeOrder: CoffeeOrderDTO) => {
    setCoffeeOrders((prevOrders) => [
      { ...newCoffeeOrder },
      ...prevOrders,
    ]);
  };

  return (
      <div className="max-w-3xl mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg">
        <CoffeeForm onCoffeeOrder={handleNewCoffeeOrder} />
        <CoffeeOrderList coffeeOrders={coffeeOrders} />
      </div>
  );
}
