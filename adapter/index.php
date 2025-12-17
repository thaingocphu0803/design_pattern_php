<?php

/**
 * Adaptee (Class không tương thích)
 * Trả dữ liệu dạng array (JSON-like), không đúng format client cần
 */
class JsonTarget {
    /**
     * Phương thức hiện có, KHÔNG đúng interface client mong muốn
     */
    public function return_json(){
        return [
            'name', 'phu'
        ];
    }
}

/**
 * Target (Interface mong muốn)
 * Client chỉ biết và chỉ làm việc với kiểu StringTarget
 */
class StringTarget {
    /**
     * Phương thức mà client mong đợi
     */
    public function return_string(){
        return 'name: phu';
    }
}

/**
 * Adapter
 * - Kế thừa Target (StringTarget) để client chấp nhận
 * - Bọc (wrap) JsonTarget để chuyển đổi dữ liệu
 */
class Adapter extends StringTarget {
    /**
     * Adapter giữ reference tới đối tượng Adaptee
     */
    public function __construct(private JsonTarget $jsonTarget){}

    /**
     * Override method của Target
     * - Gọi method của JsonTarget
     * - Chuyển đổi array → string
     */
    public function return_string()
    {
        $array = $this->jsonTarget->return_json();

        // Chuyển đổi format để client có thể dùng
        return "(TRANSFORM) ". join(':', $array);
    }
}

/**
 * Client
 * - Chỉ biết đến StringTarget
 * - Không quan tâm object bên trong là gì
 */
function client(StringTarget $stringTarget){
    echo $stringTarget->return_string();
}


/**
 * Sử dụng trực tiếp Target
 */
client(new StringTarget());

echo '<br>';

/**
 * Sử dụng Adapter
 * JsonTarget được "ngụy trang" thành StringTarget
 */
client(new Adapter(new JsonTarget()));