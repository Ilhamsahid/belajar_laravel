<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h1 class="modal-title fs-5" id="formModalLabel">Blog</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form" action="" method="post" data-method="">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input name="title" type="text" class="form-control common-input" id="title">
                        <div class="text-danger" id="errorTitle"></div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control common-input" id="description"></textarea>
                        <div class="text-danger" id="errorDescription"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closeBtn">Close</button>
                        <button type="button" id="submitBtn" class="btn btn-primary">Save</button>
                    </div>
                </form>
        </div>
    </div>
</div>