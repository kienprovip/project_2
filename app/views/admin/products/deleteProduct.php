<div>
    <div class="title px-5">
        <h5 class="p-3">Delete product</h5>
    </div>
    <div class="sure-delete_cancel px-2">
        <p class="text-center">Are you sure?</p>
        <div class="d-flex justify-content-between">
            <form action="/project_2/Admin/DeleteProduct" method="POST">
                <input type="text" name="product_idD" value="<?php echo $item['product_id'] ?>" hidden>
                <p><button class="px-3">Delete</button></p>
            </form>
            <p><button class="px-3 cancel-delete_button">Cancel</button></p>
        </div>
    </div>
</div>