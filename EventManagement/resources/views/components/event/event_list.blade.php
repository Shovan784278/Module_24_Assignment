<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-5 py-5">
                <div class="row justify-content-between ">
                    <div class="align-items-center col">
                        <h4>Event</h4>
                    </div>
                    <div class="align-items-center col">
                        <button data-bs-toggle="modal" data-bs-target="#create-modal"
                            class="float-end btn m-0 btn-sm bg-gradient-primary">Create</button>
                    </div>
                </div>
                <hr class="bg-dark " />
                <table class="table" id="tableData">
                    <thead>
                        <tr class="bg-light">
                            <th>Image</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Event Date</th>
                            <th>Event Location</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableList">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>

    getList();
    

    async function getList() {

        showLoader();
        let res = await axios.get("/list-event");
        hideLoader();

        let tableList = $("#tableList");
        let tableData = $("#tableData");

        tableData.DataTable().destroy();
        tableList.empty();

        res.data.forEach(function(item, index) {

            let row = `<tr>
                
                <td><img class="w-50 h-50" alt="" src="${item['img_url']}"></td>
                <td>${item['title']}</td>
                <td>${item['description']}</td>
                <td>${item['event_datetime']}</td>
                <td>${item['location']}</td>
                
                <td>
                    <button data-path="${item['img_url']}" data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success">Edit</button>
                    <button data-path="${item['img_url']}" data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger">Delete</button>
                </td>
                
                </tr>`

                tableList.append(row)
        })

        new DataTable('#tableData',{
        order:[[0,'desc']],
        lengthMenu:[5,10,15,20,30]
    });

        
        $('.editBtn').on('click', async function () {
           let id= $(this).data('id');
           let filePath= $(this).data('path');
           await FillUpUpdateForm(id,filePath)
           $("#update-modal").modal('show');
    })


    $('.deleteBtn').on('click',function () {
        let id= $(this).data('id');
        let path= $(this).data('path');

        $("#delete-modal").modal('show');
        $("#deleteID").val(id);
        $("#deleteFilePath").val(path)

    })

   


    }
</script>
