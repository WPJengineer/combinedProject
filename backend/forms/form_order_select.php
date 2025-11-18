<form action="/student014/online_shop/backend/db/db_order_select.php" method="POST">

    <p>
        <label for="order_id">Order ID: </label>
        <select id="order_id" name="order_id">
            <option></option>
            <!-- fetches all order ids available -->
            <!-- sort by product id -->
            <!-- sort by customer id -->
            <option value=""></option>
            <option value="-1">All</option>
        </select>
    </p>

    <p>
        <input type="submit" value="Submit">
    </p>

</form>