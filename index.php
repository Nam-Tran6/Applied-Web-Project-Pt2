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
        /* CSS selection for class categorised "items"*/
        .item {
            /* CSS styling for class "item" to have a #ccc background and margin/padding changes*/
            margin: 8em;
            padding: 3em;
            color: #1a1a1a;
            background-color: #ccc;
        }

        /*CSS for body*/
        body {
            /* Background illustration, sourced from Adobe Stock + generated with AI
            Link: https://stock.adobe.com/images/abstract-plexus-network-connection-background-with-digital-data-and-technology/1525752799?prev_url=detail*/
            background: url(styles/images/background.png);
            
            /* Background cover*/
            background-size: cover;
        }

        /*CSS for section with ID of "FrontTitle"*/
        #FrontTitle {
            color: #ccc;
            background-color: #141414;
            margin: 1em 6em 1em 6em; 
            padding: 3em 1em 3em 1em; 
            text-align: center;
            border-radius: 1em;
            font-size: 2em;

            /*Converts section into 2 columns with grid*/
            display: grid;
            grid-template-columns: repeat(2, 1fr);
        }

        /*Selects all sections within the article semantic*/
        article {
            /* utilises grid to produce 2 columns and 2 rows*/
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-template-rows: repeat(2, 1fr);
        }

        #cloudpicture {
            text-align: center;
            margin: 1em;
            color: #ccc;
            font-style: italic;
        }
    </style>
</head>

<body>
    <?php
        // .inc header inclusion
        include "header.inc";
    ?>
    
<main>
    <figure id = "cloudpicture">
        <img src="images/Box.png" alt= "Icon of a cloud with connected network nodes representing cloud storage"> 
        <figcaption>
        For all your storage needs
        </figcaption>
    </figure>
    <!--Image of cloud storage to illustrate business plan-->
    
        
    <!--Section for Front-Title-->
    <section id="FrontTitle">
    
    <!--Heading introducing user to the business-->
    <h1>
        Welcome to <br> 
        &lt;--- The Box&#8482; ---&gt;
    </h1>

    <!--Short introductionary paragraph with inline CSS to override external CSS rule-->
        <p style = "color: grey;">
            A new innovative tech-startup that utilises quantum technology to produce an unfathomable amount of storage space
        </p>
    </section>

    <article>
        <!--Top Left Description detailing The Box business-->
        <section class="item">
            <h2>What is the BOX?</h2>
            <p> A new method to store data, utilising cutting edge innovations from quantum mechanics to expand into the
                infinite realm of data storage. </p>
        </section>

        <!--Top Right Description detailing the team behind The Box-->
        <section class="item">
            <h2>Who are We?</h2>
            <p> We are a cutting-edge team of programmers and engineers who wish to create the building blocks of a new
                way to store. </p>
        </section>

        <!--Bottom Left Description detailing what The Box offers-->
        <section class="item">
            <h2>What do we offer?</h2>
            <p> We operate on both a B2B and B2P model, providing every consumer, no matter how big or small, the
                opportunity to access our infinite servers. </p>
        </section>

        <!--Bottom Right Description detailing liabilities-->
        <section class="item">
            <h2>Pandora's Box</h2>
            <p> The BOX is not liable if somehow, we open an interdimensional rift into some kind of wierd data world.
                We would happily worship our Data Overloads though. </p>
        </section>
    </article>
</main>

    <?php
        // header footer
        include "footer.inc";
    ?>
</body>

</html>