<option class="city" selected value="">City</option>
<?php foreach($cities as $city){ ?>
    <?php $selected = (!empty($c) && $c == $city->city)?'selected':''; ?>
    <option <?php echo $selected; ?> class="city <?php echo $city->code; ?>" value="<?php echo $city->city ?>"><?php echo $city->city; ?></option>
<?php } ?>