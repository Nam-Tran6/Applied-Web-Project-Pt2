<!DOCTYPE html>
<html lang="en">

<head>
    <!--Meta Tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Kha Nam Tran">
    <meta name="description" content="The home page for the startup quantum storage company 'The Box', serving as an
    introduction and index for new viewers. ">
    <meta name="keywords" content="The Box, Quantum Storage, Data Memory, Yottabyte, Information Protection, Index of The Box">

    <!--Title-->
    <title>The Box</title>

    <!--Link to Stylesheet-->
    <link rel="stylesheet" href="styles/layout.css" type="text/css">

    <style>
        .item {
            /* selects all class of items*/
            margin: 8em;
            padding: 3em;
            color: #1a1a1a;
            background-color: #ccc;
            border-radius: 1em;
            /* Defines margin, padding, font color, background color, and radius for rectangle edges*/
        }

        body {
            background: url(styles/images/background.png);
            /* Background illustration*/
            background-size: cover
                /* Background cover*/

            /* Image was sourced from Adobe Stock and generated with AI 
            Link: https://stock.adobe.com/images/abstract-plexus-network-connection-background-with-digital-data-and-technology/1525752799?prev_url=detail
            */
        }

        /*styling for heading*/
        #CatchyPhrase h1, {
            color: #ccc;
            padding: 10px 10px;
            margin: 5%;
            text-align: center;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <?php
        // header inclusions
        include "header.inc";
    ?>

    <main>
        <!--Heading containing catchy phrase and description-->
        <section id="CatchyPhrase">
            <h1>
                Welcome to The Box&#8482;
            </h1>

            <p>
                Not Gigabytes, Terrabytes, or even Petabyte. Think as bold as us, think Yottabyte.
            </p>
        </section>

        
        <!--Description 1-->
        <section class="item">
            <h2>What is the BOX?</h2>
            <p> A new method to store data, utilising cutting edge innovations from quantum mechanics to expand into the
                infinite realm of data storage. </p>
        </section>

        <!--Description 2-->
        <section class="item">
            <h2>Who are We?</h2>
            <p> We are a cutting-edge team of programmers and engineers who wish to create the building blocks of a new
                way to store. </p>
        </section>

        <!--Description 3-->
        <section class="item">
            <h2>What do we offer?</h2>

            <p> We operate on both a B2B and B2P model, providing every consumer, no matter how big or small, the
                opportunity to access our infinite servers. </p>
        </section>

        <!--Description 4-->
        <section class="item">
            <h2>Pandora's Box</h2>
            <p> The BOX is not liable if somehow, we open an interdimensional rift into some kind of wierd data world.
                We would happily worship our Data Overloads though. </p>
        </section>
    </main>

    <?php
        // header footer
        include "footer.inc";
    ?>
</body>

</html>