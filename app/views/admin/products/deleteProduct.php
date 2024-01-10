<div class="w-100">
    <div class="title px-5 text-center delete-product_title">
        <h5 class="p-3">Delete product</h5>
    </div>
    <div class="sure-delete_cancel px-2">
        <p class="text-center">Are you sure?</p>
        <div class="d-flex justify-content-center">
            <form action="/project_2/Admin/checkdeleteproduct" method="POST">
                <input type="text" name="product_idD" value="<?php echo $data['delete'] ?>" hidden>
                <p><button class="px-3 accept-delete-product me-3 fw-bold">Delete</button></p>
            </form>
            <p class="m-0 ms-3"><a href="/project_2/admin/products" class="d-flex justify-content-center align-items-center px-3 py-1 cancel-delete_button fw-bold">Cancel</a></p>
        </div>
    </div>
</div>
<style>
    .delete-product_title {
        background-color: #009d63;
        color: #fff;
    }

    .cancel-delete_button {
        text-decoration: none;
        color: #009d63;
    }

    .accept-delete-product {
        color: #009d63;
        border: none;
        background: none;
    }

    .accept-delete-product:hover,
    .cancel-delete_button:hover {
        background-color: #009d63;
        color: #fff;
    }
</style>