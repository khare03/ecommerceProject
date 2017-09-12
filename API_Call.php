<?php
if(!empty($_GET['search']))
{
    $prod = ($_GET['search']);
    //Fetching information based on search from Walmart
    $Walmart_endpoint = 'http://api.walmartlabs.com/v1/search?query='.urlencode($prod).'&format=json&apiKey=2hzbk6cqpyd3xja5qh92b7ph';
    $getContentWal = file_get_contents($Walmart_endpoint);
    $contentDecodedWal = json_decode($getContentWal,true);
    $arrayObjWal = ($contentDecodedWal[items]);

    //Fetching information based on search from eBay
    $ebay_endpoint = 'http://svcs.ebay.com/services/search/FindingService/v1?OPERATION-NAME=findItemsByKeywords&SERVICE-VERSION=1.12.0&SECURITY-APPNAME=Anukrati-geadproj-PRD-3090738eb-63683892&RESPONSE-DATA-FORMAT=json&REST-PAYLOAD&keywords=' .urlencode($prod);
    $getContentEbay = file_get_contents($ebay_endpoint);
    $contentDecodedEbay = json_decode($getContentEbay,true);
    $arrayObjEbay = ($contentDecodedEbay['findItemsByKeywordsResponse'][0]['searchResult'][0]['item']);
    $arrayObjEbayPrice = ($arrayObjEbay[0]['sellingStatus'][0]);

    # fetching info from DB
    $foundItem= getUploadedDetails($prod);

}
?>