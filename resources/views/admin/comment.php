           <!-- sa-app__body -->
           <div id="top" class="sa-app__body">
                <div class="mx-xxl-3 px-4 px-sm-5">
                    <div class="py-5">
                        <div class="row g-4 align-items-center">
                            <div class="col">
                                <h1 class="h3 m-0">Orders</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mx-xxl-3 px-4 px-sm-5 pb-6">
                    <div class="sa-layout">
                        <div class="sa-layout__backdrop" data-sa-layout-sidebar-close=""></div>
                        <div class="sa-layout__content">
                            <div class="card table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                <input type="checkbox"
                                                    class="form-check-input m-0 fs-exact-16 d-block" />
                                            </th>
                                            <th style="width: 10%;">Customer</th>
                                            <th style="width: 8%;">Classification</th>
                                            <th style="width: 15%;">Material</th>
                                            <th style="width: 10%;">Description</th>
                                            <th style="width: 25%;">Evaluation</th>
                                            <th style="width: 10%;">Evaluation date</th>
                                            <th style="width: 12%;">Admin response</th>
                                            <th style="width: 5%;"></th>
                                            <th style="width: 5%;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            
                                            foreach ($showall_review as $item) {
                                                extract($item);
                                                echo'
                                                    <tr>
                                                    <td><input type="checkbox" class="form-check-input m-0 fs-exact-16 d-block"
                                                            aria-label="..." />
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                <a href="#" class="text-reset">'.$hoten.'</a>
                                                                <div class="sa-meta mt-0">
                                                                    <ul class="sa-meta__list">
                                                                        <li class="sa-meta__item">ID:
                                                                            <span title="Click to copy product ID" class="st-copy">'.$madg.'</span>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="sa-price">                                              
                                                            <span class="sa-price__integer">'.$size.'-'.$color.'</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="sa-price">                                              
                                                            <span class="sa-price__integer">'.$chatluong.'</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="sa-price">                                              
                                                            <span class="sa-price__integer">'.$mota.'</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="sa-price">                                              
                                                            <span class="sa-price__integer">'.$noidung.'</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="sa-price">                                              
                                                            <span class="sa-price__integer">'.$ngaybl.'</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="sa-price">                                              
                                                            <span class="sa-price__integer">'.$feedback.'</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                    <button onclick="showForm('.$madg.')" style="background-color: white; color: black; border: 2px solid black; border-radius: 10px;">Feedback</button>
                                                </td>
                                                <td>
                                                    <button onclick="deleteDG('.$madg.')" style="background-color: white; color: red; border: 2px solid red; border-radius: 10px;">Delete</button>
                                                </td>
                                                <!-- Form phản hồi -->
                                                    <div id="fph'.$madg.'" style="display: none;">
                                                
                                                    <div style="display: flex; justify-content: center; align-items: center; height: 250px;">
                                                        <div>
                                                            <div>
                                                                <h5>Feedback to the buyer : '.$madg.'</h5>
                                                                
                                                            </div>
                                                            <form action="?mod=comment&act=feedback" method="POST">
                                                                <input hidden name="madg" value="'.$madg.'">
                                                                <div class="form-group">
                                                                    <h8 style="display: block; text-align: center; font-size: larger;">Prepare information</h8>
                                                                    <input type="text" name="seller_feedback" class="form-control" id="inputPH'.$madg.'" placeholder="Please enter a response or select from available responses" style="margin-bottom: 10px;">
                                                                    <select name="" id="selectOption'.$madg.'" style="width: 100%; height: 35px;">
                                                                        <option value="">Select available answers :</option>
                                                                        <option value="">Thank you for your purchase.</option>
                                                                        <option value="">Sorry you had a bad experience. If you need assistance, please contact me :</option>
                                                                    </select>
                                                                </div>
                                                                <br>
                                                                <div style="text-align: center;">
                                                                    <input type="submit" name="feedback" class="btn btn-outline-secondary" value="Submit feedback">
                                                                    <button type="button" onclick="hideForm('.$madg.')" class="btn btn-outline-secondary">
                                                                    Close
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                </tr>';
                                                
                                                }
                                                ?>
                                                
                                                </tbody>
                                                
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                                                
                                                
<script type="text/javascript">
    // Lấy tất cả các thẻ select
    var selects = document.querySelectorAll('select');

    // Thêm sự kiện cho mỗi thẻ select
    selects.forEach(function(select) {
        select.addEventListener('change', function() {
            // Lấy ID của thẻ select
            var id = this.id.replace('selectOption', '');

            // Tìm thẻ input tương ứng
            var input = document.getElementById('inputPH' + id);

            // Cập nhật giá trị của thẻ input
            if (input) {
                input.value = this.options[this.selectedIndex].innerText;
            }
        });
    });
                                                                                                  
    function showForm(madg) {
        document.getElementById('fph'+madg).style.display = 'block';
    }

    function hideForm(madg) {
        document.getElementById('fph'+madg).style.display = 'none';
    }
    function deleteDG(madg) {
        var kq = confirm("Are you sure you want to delete this product?");
        if(kq){
            window.location.search='?mod=comment&act=delete&id='+madg; 
        }
    }
</script>
