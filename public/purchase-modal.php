
<div class='purchase-modal-container modal-container'>
    
    <div class='remove-modal'>
        <div class='modal-header'>
            <h3>Confirmation</h3>
        </div>
        <div class='modal-content'>
            <div id='payment-step-1'>
                <p>Total Amount: HK$<?php echo $_SESSION['totalPrice'];?></p>
                <div class='btn-group'>
                    <button class='btn edit-btn' id='cancel-btn'>Cancel</button>
                    <input type='button' class='btn buy-btn' id='confirm-total-btn' value='Confirm'>
                </div>
            </div>
            <div id='payment-step-2'>
                step 2
                <div class='btn-group'>
                    <button class='btn edit-btn' id='cancel-btn'>Cancel</button>
                    <input type='button' class='btn buy-btn' id='purchase-all-btn' value='Purchase'>
                </div>
            </div>
        </div>
    </div>

</div>