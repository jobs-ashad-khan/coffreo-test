"use client";

import {useState} from "react";
import {CoffeeOrderDTO} from "@/types/CoffeeOrderDTO";
import CoffeeForm from "@/app/components/CoffeeForm";

export default function Home() {
  const [coffeeOrders, setCoffeeOrders] = useState<CoffeeOrderDTO[]>([]);

  const handleNewCoffeeOrder = async (newCoffeeOrder: CoffeeOrderDTO) => {
    setCoffeeOrders((prevOrders) => [
      ...prevOrders,
      { ...newCoffeeOrder },
    ]);
  };

  return (
      <div className="max-w-3xl mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg">
        <CoffeeForm onCoffeeOrder={handleNewCoffeeOrder} />
      </div>
  );
}
