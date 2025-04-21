$(function () {
    $('.addModal').on('click', function () {
        let addRoute = $(this).data('action');

        $('#formModalLabel').html('Add Blog');
        $('.modal-footer button[id=submitBtn]').html('Add');
        $('#form').attr('action', addRoute);
        $("#form").attr('data-method', 'POST');
    });

    $('.updateModal').on('click', async function () {
        let updateRoute = $(this).data('action');
        let id = $(this).data("id");

        $('#formModalLabel').html('Change Blog');
        $('.modal-footer button[id=submitBtn]').html('Change');
        $('#form').attr('action', updateRoute);
        $("#form").attr('data-method', 'PUT')

        document.getElementById("title").value = "loading...";
        document.getElementById("description").value = "loading...";

        try {
            let response = await fetch('/blog/data/' + id);
            let data = await response.json();

            if (data.error) {
                console.log(data.error);
                return;
            }

            document.getElementById("title").value = data.title;
            document.getElementById("description").value = data.description;
        } catch (error) {
            console.error("Error fetching data:", error);
            document.getElementById("title").value = "Error loading data";
            document.getElementById("description").value = "Error loading data";
        }
    });

    $('.modal-footer button[id=closeBtn]').on('click', function () {
        document.getElementById('errorTitle').innerText = "";
        document.getElementById('errorDescription').innerText = "";
        document.getElementById('title').value = "";
        document.getElementById('description').value = "";
    });
})