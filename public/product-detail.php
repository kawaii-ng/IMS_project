<div class="detail-modal" id="product-123-modal">

    <i class="close-btn far fa-window-close" id='product-123-close'></i>

    <form action="" method="post" class='purchase-form'>
    <div class="purchase-section">
        <div>
            <strong>
                <h1>Oversized jacket</h1>
                <small>Women</small>
            </strong>
            <br>
            <p>Short dress in patterned jersey with narrow shoulder straps that cross and tie at the black. </p>
            <br>
            <h3>HK$1,000.00</h3>
           
                <input type="hidden" name="price" value="1000">
                <div class="counter">
                    <a class="count-btn" id='count-add-btn'>
                        <i class="fas fa-plus-square"></i>
                    </a>
                    <input type="text" value='1' id="count">
                    <a class="count-btn" id="count-minus-btn">
                        <i class="fas fa-minus-square"></i>
                    </a>
                </div>
                <input id='product-123-btn' type="submit" value="Add to Cart"></input>
        </div>
    </div>
    
    <div class="detail-section">
        <div>
            <h5>Colors</h5>
            <input type="hidden" name="color" id="color" value="">
            <div id="product-123-color-1" class="color color-size-active" style="background: #007777"></div>
            <div id="product-123-color-2" class="color" style="background: #770077"></div>
            <br>
            <h5>Sizes</h5>
            <input id="size" type="hidden" name="size" value="">
            <div id="product-123-size-1" class="size color-size-active">
                XS
            </div>
            <div id="product-123-size-2" class="size">
                SS
            </div>
            <div id="product-123-size-3" class="size">
                S
            </div>
        </div>
        
    </div>
    </form>

    <div class="img-section">
        <img src="./images/t-shirt.jpeg" alt="">
    </div>

</div>
