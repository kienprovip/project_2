<div class="w-100">
    <div class="title px-5 text-center">
        <h5 class="p-3">Delete product</h5>
    </div>
    <div class="sure-delete_cancel px-2">
        <p class="text-center">Are you sure?</p>
        <div class="d-flex justify-content-center">
            <form action="/project_2/Admin/checkdeleteproduct" method="POST">
                    <input type="text" name="product_idD" value="<?php echo $data['delete'] ?>" hidden>
                <p><button class="px-3">Delete</button></p>
            </form>
            <p><a href="/project_2/admin/products" class="px-3 cancel-delete_button">Cancel</a></p>
        </div>
    </div>
</div>