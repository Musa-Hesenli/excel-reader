<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link href="https://bootswatch.com/5/lux/bootstrap.min.css" rel="stylesheet"/>

    </head>
    <body>
        <div class="container my-5">
            <div class="row">
                <div class="col-md-6">
                    <input class="form-control mb-3" placeholder="Mehsulun linkini daxil edin">
                    <button id="submit_btn" class="btn btn-block btn-primary w-100">Axtar</button>
                </div>
            </div>
        </div>
    </body>
    <script>
        const submitBtn = document.getElementById( 'submit_btn' );
        submitBtn.addEventListener( 'click', async function () {
            const productURL = document.querySelector( "input" ).value;
            if ( productURL.length === 0 ) {
                alert( "Please enter product link" );
                return;
            }

            changeBtnStatus();

            const response = await fetch( '/api/parse-product-link', {
                method: "POST",
                body: JSON.stringify({
                    link: productURL
                }),
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            } );

            const json = await response.json();
            changeBtnStatus('reset');
            alert( JSON.stringify( json ) );
        } );

        function changeBtnStatus(to)
        {
            if ( to === 'reset' )
            {
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Axtar'
            }
            else
            {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="spinner-border"></span>'
            }
        }
    </script>
</html>

