<?php

/**
 * Strategy interface
 * - Định nghĩa một hành vi (algorithm) chung
 */
interface Strategy {
    public function work($array) : array;
}


/**
 * Child Strategy A
 * - Cài đặt thuật toán sắp xếp tăng dần
 */
class ChildStrategyA implements Strategy {
    public function work($array): array{
        sort($array);

        return $array;
    }
}

/**
 * Child Strategy B
 * - Cài đặt thuật toán sắp xếp giảm dần
 */
class ChildStrategyB implements Strategy {
    public function work($array): array{
        rsort($array);

        return $array;
    }
}


/**
 * Context
 * - Chứa reference tới Strategy
 * - Không biết chi tiết thuật toán bên trong strategy
 * - Cho phép thay đổi strategy tại runtime
 */
class Context {
     /**
     * Inject Strategy thông qua constructor
     */
    public function __construct(private Strategy $strategy){}

    /**
     * Thay đổi strategy trong lúc chương trình đang chạy
     */
    public function setStrategy(Strategy $strategy){
        $this->strategy = $strategy;
    }

    /**
     * Thực thi thuật toán của strategy hiện tại
     */
    public function execute(){
        $array= [2,1,4,9,7];

        $newArray = $this->strategy->work($array);

        echo join(',', $newArray);

    }
}

// Khởi tạo Context với Strategy A (sắp xếp tăng dần)
$context = new Context(new ChildStrategyA());
echo "Child Strategy A work: ";
$context->execute();

echo "<br>";

// Đổi strategy sang Strategy B (sắp xếp giảm dần)
$context->setStrategy(new ChildStrategyB());
echo "Child Strategy B work: ";
$context->execute();
