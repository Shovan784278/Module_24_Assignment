<div class="modal" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Event</h5>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">

                                

                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" id="eventTitle">
                                <label class="form-label">Description</label>
                                <input type="text" class="form-control" id="eventDescription">
                                <label class="form-label">Event Date</label>
                                <input type="datetime-local" class="form-control" id="eventDatetime">
                                <label class="form-label">Location</label>
                                <input type="text" class="form-control" id="eventLocation">

                                <br/>
                                <img class="w-15" id="newImg" src="{{asset('images/default.jpg')}}"/>
                                <br/>

                                <label class="form-label">Image</label>
                                <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])" type="file" class="form-control" id="eventImg">


                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="Save()" id="save-btn" class="btn btn-sm  btn-success" >Save</button>
                </div>
            </div>
    </div>
</div>


<script>

    // FileCategoryDropDown();

    // async function FileCategoryDropDown(){

    //     let res = await axios.get("/list-category");

    //     res.data.forEach(function(item,index){

    //         let option = `<option value="${item['id']}">${item['name']}</option>`
    //         $('#productCategory').append(option);
    //     });

    // }


    async function Save(){

        
        let eventTitle = document.getElementById('eventTitle').value;
        let eventDescription = document.getElementById('eventDescription').value;
        let eventDatetime = document.getElementById('eventDatetime').value;
        let eventLocation = document.getElementById('eventLocation').value;
        let eventImg = document.getElementById('eventImg').files[0];

        if(eventTitle.length === 0){

            errorToast("Title is Required");

        }else if(eventDescription.length === 0){

            errorToast("Description is Required");

        }else if(eventDatetime.length === 0){

            errorToast("DateTime is Required");

        }else if(eventLocation.length === 0){

            errorToast("Location is Required");

        }else if(!eventImg){

            errorToast('Event Image Required');

        }

        else{

            document.getElementById('modal-close').click();

            let formData = new FormData();
           
            formData.append('img_url', eventImg);
            formData.append('title', eventTitle);
            formData.append('description', eventDescription);
            formData.append('event_datetime', eventDatetime);
            formData.append('location', eventLocation);
            

            const config = {

                headers: {

                    'content-type' : 'multipart/form-data'
                }

            }

            showLoader();
            let res = await axios.post("/create-event",formData,config);
            hideLoader();
            
            if(res.status === 201){
                
                successToast("Request Completed");
                document.getElementById("save-form").reset();
                await getList();
            }
            else{

                errorToast("Request Failed");
            }
        }



    }
    

</script>