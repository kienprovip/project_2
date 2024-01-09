<?php
class FeedbackModel extends Model
{
    protected $table = '';

    public function getFeedbacks()
    {
        $this->table = 'feedbacks';
        $data = $this->db->query("SELECT * FROM $this->table")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getFeedbacksForProductDetail($id)
    {
        $this->table = 'feedbacks';
        $data = $this->db->query("SELECT c.color_name, c.size_name, a.feedback_message, b.customer_image, b.customer_name, a.feedback_datetime FROM $this->table a INNER JOIN customers b ON a.customer_id = b.customer_id INNER JOIN variations c ON a.variation_id = c.variation_id WHERE a.product_id = $id")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function addFeedback($dataFeedback)
    {
        $this->table = 'feedbacks';
        $data = [
            'customer_id' => $dataFeedback['customerid'],
            'product_id' => $dataFeedback['productid'],
            'variation_id' => $dataFeedback['variationid'],
            'orderdetail_id' => $dataFeedback['orderdetailid'],
            'feedback_message' => $dataFeedback['feedbackmessage'],
            'feedback_datetime' => $dataFeedback['feedbackdatetime'],
            'feedback_status' => 1
        ];
        $status = $this->db->insert($this->table, $data);
        if ($status) {
            return true;
        }
        return false;
    }
}
