<?php

/**
 * Singleton base class
 * - Đảm bảo mỗi class chỉ có MỘT instance duy nhất
 * - Hỗ trợ kế thừa (mỗi subclass sẽ có instance riêng)
 */
class Singleton
{
    /**
     * Lưu trữ các instance theo tên class
     */
    protected static $instance = [];

    /**
     * Constructor protected
     * - Không cho khởi tạo bằng new từ bên ngoài
     */
    protected function __construct() {}

    /**
     * Ngăn không cho clone object
     */
    protected function __clone() {}

    /**
     * Ngăn không cho unserialize object
     */
    public function __wakeup() {
        throw new Exception('Can not wakeup!!');
    }

    /**
     * Trả về instance duy nhất của class đang được gọi
     * (sử dụng Late Static Binding)
     *
     * @return static
     */
    public static function getInstance(){
         // Lấy tên class thực sự đang gọi method này
        $class = static::class;
        // Nếu instance của class này chưa tồn tại thì tạo mới
        if(!isset(self::$instance[$class])){
            // new static() đảm bảo tạo đúng instance của subclass
            self::$instance[$class] = new static();
        }

        // Trả về instance đã được tạo (hoặc đã tồn tại)
        return self::$instance[$class];
    }
}

// Lần gọi đầu tiên → tạo instance
$instance1 = Singleton::getInstance();

// Lần gọi thứ hai → trả về instance cũ
$instance2 = Singleton::getInstance();

// So sánh
if($instance1 === $instance2){
    echo 'Singleton work!';
}else{
    echo 'Singleton not work!';
}
