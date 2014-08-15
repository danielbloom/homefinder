<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Homefinder</title>
  <meta name="description" content="Homefinder">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
</head>
<body>
    
<header>
    <h1>Find Home. The No Frills Home Search.</h1>
</header>

<div id="mainContent">
    <form id="filter">
        <input name="area" placeholder="Area (e.g. Chicago, IL)"> Price range

        <select name="price_min">
            <option value="">Min Price</option>
            <option value="10000">$10,000</option>
            <option value="20000">$20,000</option>
            <option value="30000">$30,000</option>
            <option value="50000">$50,000</option>
            <option value="100000">$100,000</option>
            <option value="130000">$130,000</option>
            <option value="150000">$150,000</option>
            <option value="200000">$200,000</option>
            <option value="250000">$250,000</option>
            <option value="300000">$300,000</option>
            <option value="350000">$350,000</option>
            <option value="400000">$400,000</option>
            <option value="450000">$450,000</option>
            <option value="500000">$500,000</option>
            <option value="550000">$550,000</option>
            <option value="600000">$600,000</option>
            <option value="650000">$650,000</option>
            <option value="700000">$700,000</option>
            <option value="750000">$750,000</option>
            <option value="800000">$800,000</option>
            <option value="850000">$850,000</option>
            <option value="900000">$900,000</option>
            <option value="950000">$950,000</option>
            <option value="1000000">$1M</option>
            <option value="1100000">$1.1M</option>
            <option value="1200000">$1.2M</option>
            <option value="1250000">$1.25M</option>
            <option value="1400000">$1.4M</option>
            <option value="1500000">$1.5M</option>
            <option value="1600000">$1.6M</option>
            <option value="1700000">$1.7M</option>
            <option value="1750000">$1.75M</option>
            <option value="1800000">$1.8M</option>
            <option value="1900000">$1.9M</option>
            <option value="2000000">$2M</option>
            <option value="2250000">$2.25M</option>
            <option value="2500000">$2.5M</option>
            <option value="2750000">$2.75M</option>
            <option value="3000000">$3M</option>
            <option value="3500000">$3.5M</option>
            <option value="4000000">$4M</option>
            <option value="5000000">$5M</option>
            <option value="10000000">$10M</option>
        <option value="20000000">$20M</option>   
        </select> to
        <select name="price_max">
            <option value="">Max Price</option>
            <option value="10000">$10,000</option>
            <option value="20000">$20,000</option>
            <option value="30000">$30,000</option>
            <option value="50000">$50,000</option>
            <option value="100000">$100,000</option>
            <option value="130000">$130,000</option>
            <option value="150000">$150,000</option>
            <option value="200000">$200,000</option>
            <option value="250000">$250,000</option>
            <option value="300000">$300,000</option>
            <option value="350000">$350,000</option>
            <option value="400000">$400,000</option>
            <option value="450000">$450,000</option>
            <option value="500000">$500,000</option>
            <option value="550000">$550,000</option>
            <option value="600000">$600,000</option>
            <option value="650000">$650,000</option>
            <option value="700000">$700,000</option>
            <option value="750000">$750,000</option>
            <option value="800000">$800,000</option>
            <option value="850000">$850,000</option>
            <option value="900000">$900,000</option>
            <option value="950000">$950,000</option>
            <option value="1000000">$1M</option>
            <option value="1100000">$1.1M</option>
            <option value="1200000">$1.2M</option>
            <option value="1250000">$1.25M</option>
            <option value="1400000">$1.4M</option>
            <option value="1500000">$1.5M</option>
            <option value="1600000">$1.6M</option>
            <option value="1700000">$1.7M</option>
            <option value="1750000">$1.75M</option>
            <option value="1800000">$1.8M</option>
            <option value="1900000">$1.9M</option>
            <option value="2000000">$2M</option>
            <option value="2250000">$2.25M</option>
            <option value="2500000">$2.5M</option>
            <option value="2750000">$2.75M</option>
            <option value="3000000">$3M</option>
            <option value="3500000">$3.5M</option>
            <option value="4000000">$4M</option>
            <option value="5000000">$5M</option>
            <option value="10000000">$10M</option>
            <option value="20000000">$20M</option>        
        </select>
        <select name="beds">
            <option value="1">Bedrooms</option>
            <option value="1">1 Bedroom</option>
            <option value="2">2 Bedrooms</option>
            <option value="3">3 Bedrooms</option>
            <option value="4">4 Bedrooms</option>
            <option value="5">5 Bedrooms</option>
            <option value="6">6 Bedrooms</option>
            <option value="7">7 Bedrooms</option>
            <option value="8">8 Bedrooms</option>
        </select>
        <input type="hidden" name="page" value="1">
        <input type="button" id="searchButton" value="search">
    </form>
    <div id="errorMessage">Errors</div>
    <div id="summary"></div>
    <div id="container"></div>
    <div id="pagination"></div>        
</div>
<footer></footer>

<script id="homeTemplate" type="text/template">
    <% _.each(listings,function(home){ %>
        <div class="listing" data-mlsId="<%= home.mlsId %>">
            <a href="<%= home.url %>" class="home-image" target="_blank">
                <img src="images/ajax-loader.gif" data-src="<%= (home.hasOwnProperty('primaryPhoto')) ? home.primaryPhoto.url : ''%>">
            </a>
            <div class="address"><%= home.address.line1 %></div>
            <span class="price">$<%= numberWithCommas(home.price) %></span>
            <div><%= home.address.city %> <%= home.address.zip %></div> 
            
            <div class="home-type"><%= home.type %> </div>
            <div><%= home.bed %> beds, <%= (home.bath.hasOwnProperty('total')) ? home.bath.total : '?' %> baths</div>
            <div class="description" data-mlsId="<%= home.mlsId %>"><%= home.description %></div>
            <a href="<%= home.url %>" target="_blank" class="details">Details</a>
        </div>
    <% }) %>
</script>

<script src="assets/js/homefinder.js"></script>
</body>
</html>