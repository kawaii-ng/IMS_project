
<div class='purchase-modal-container modal-container'>
    
    <div class='modal purchase-modal'>
        <div class='modal-header'>
            <h3>Payment</h3>
        </div>
        <div class='modal-content'>
            
            <div class='purchase-panel'>
                
                <div>
                    <div class='credit-card'>

                        <i class="fab fa-cc-visa"></i>
                        <h2 class='card-card-number'>1234 5678 8765 4321</h2>
                        <div class='card-bottom'>
                            <div>
                                <h6>CARD HOLDER</h6>
                                <h4 id='card-card-name'>John Smith</h4>
                            </div>
                            <div>
                                <h6>EXPIES</h6>
                                <h4><span id='card-card-month'>09</span>/<span id='card-card-year'>20</span></h4>
                            </div>
                            <div>
                                <h6>CVC</h6>
                                <h4 id='card-card-cvc'>345</h4>
                            </div>
                        </div>

                    </div>
                </div>
                <div>
                    <table>
                        <tr>
                            <td colspan='3'>
                                
                                <h3>Payment Details</h3>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='3'>
                                <label for="card-holder">Card Holder Name</label>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='3'>
                                <input type="text" id='card-holder' placeholder='John Smith' >
                            </td>
                        </tr>
                        <tr>
                            <td colspan='3'>
                                <label for="card-num">Card Number</label>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='3'>
                                <input type="number" id='card-num' placeholder='1234 5678 8765 4321' max='9999999999999999'>
                            </td>
                        </tr>
                        <tr>
                            <td>

                                <label for="expiry-month">Expiry Month</label>
                            </td>
                            <td>
                                <label for="expiry-year">Expiry Year</label>

                            </td>
                            <td>

                                <label for="cvc">CVC</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="number" id='expiry-month' placeholder='09' max='99'>

                            </td>
                            <td>
                                <input type="number" id='expiry-year' placeholder='20' max='99'>

                            </td>
                            <td>
                                <input type="number" id='cvc' placeholder='345' max='99'>

                            </td>
                        </tr>
                        <tr>
                            <td colspan='3'>
                                <p id='total-amount'>Total Amount: <span>HK$<?php echo $_SESSION['totalPrice'];?></span></p>
                            </td>
                        </tr>
                    </table>
                    
                    <div class='btn-group'>
                        <button class='btn edit-btn' id='cancel-btn'>Cancel</button>
                        <input type='button' class='btn buy-btn' id='purchase-all-btn' value='Purchase'>
                    </div>
                </div>
                
            </div>

               
        </div>
    </div>

</div>