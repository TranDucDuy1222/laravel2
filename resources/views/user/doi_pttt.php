<?php foreach ($data['pttt'] as $sp): ?>  
<form action="" method="post">
<div class="container">
    <div class="row" style="padding-top: 50px;">
        <div class="col-12 border " style="height: 40vh;">
                <h4 style="text-align: center; font-weight: bold; letter-spacing: 1px; padding: 5px;">Please provide payment method</h4>
                <select class="custom-select" name="pttt" id="">
                    <?php
                        $cach_tt = [
                            'Payment on delivery',
                            'Payment by bank',
                            'Pay by credit/debit card'
                        ];

                        foreach ($cach_tt as $tt) {
                            $a = ($sp['pttt'] === $tt) ? 'selected' : '';
                            echo "<option  value=\"$tt\" $a>$tt</option>";
                        }
                    ?>
                </select>
        </div>
    </div>
    <div class="row" style="padding-top: 10px; padding-bottom: 30px;">
        <div class="col-10"></div>
        <div class="col-2">
            <button style="margin-left: 70px;" type="submit" name="submit" class="btn btn-outline-secondary">Save</button>
        </div>
    </div>
</div>
</form>
        <?php endforeach; ?>