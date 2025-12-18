<?php

/**
 * Interface Transport
 * -------------------
 * Khai báo interface chung cho các phương tiện vận chuyển.
 * Mọi phương tiện đều phải implement phương thức getName().
 */
interface Transport {
	public function getName() : string;
}

/**
 * Class Truck
 * -----------
 * Concrete Product: Xe tải
 * Implement interface Transport.
 */
class Truck implements Transport{
	public function getName()  : string
	{
		return 'TRUCK';
	}
}

/**
 * Class Ship
 * ----------
 * Concrete Product: Tàu thủy
 * Implement interface Transport.
 */
class Ship implements Transport{
	public function getName()  : string
	{
		return 'SHIP';
	}
}

/**
 * Abstract Class Logic
 * --------------------
 * Creator (Factory Method Pattern)
 * - Khai báo factoryMethod() để tạo Transport
 * - Không biết cụ thể sẽ tạo Truck hay Ship
 */
abstract class Create {

	/**
	 * Factory Method
	 * --------------
	 * Các subclass sẽ quyết định tạo object Transport nào.
	 */
	abstract public function factoryMethod() : Transport;

	/**
	 * Business logic chung
	 * --------------------
	 * Sử dụng object được tạo ra từ factoryMethod()
	 * mà không cần biết concrete class là gì.
	 */
	public function delivery() :string{
		$transport = $this->factoryMethod();
		return 'We deliver by ' . $transport->getName();
	}
}

/**
 * Class TruckCreate
 * ----------------
 * Concrete Creator
 * Quyết định tạo đối tượng Truck.
 */
class TruckCreate extends Create {
	public function factoryMethod(): Transport
	{
		return new Truck();
	}
}

/**
 * Class ShipCreate
 * ---------------
 * Concrete Creator
 * Quyết định tạo đối tượng Ship.
 */
class ShipCreate extends Create {
	public function factoryMethod(): Transport
	{
		return new Ship();
	}
}

/**
 * Client code
 * -----------
 * Chỉ làm việc với abstract class Logic,
 * không phụ thuộc vào concrete class (TruckCreate hay ShipCreate).
 */
function client(Create $logic){
	echo $logic->delivery();
}

// Client sử dụng TruckCreate
client(new TruckCreate);

echo '<br>';

// Client sử dụng ShipCreate
client(new ShipCreate);