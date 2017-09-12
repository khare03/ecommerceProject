
    $(document).ready(function() {
        $('#box').autocomplete({
            source: function(Query, Response) {
                $.ajax({
                    url: "http://completion.amazon.com/search/complete",
                    dataType: "jsonp",
                    data: {
                        q: Query.term,
                        "search-alias": "aps",
                        client: "amazon-search-ui",
                        mkt: 1,

                    },
                    success: function(Data) {

                        if (Data) {
                            var DataArr = Data.toString().split(',');
                            var Queries = new Array();
                            for (var q = 1; q < (DataArr.length - 1); q++) {
                                DataArr[q] = $.trim(DataArr[q]);
                                if (0 < DataArr[q].length && DataArr[q] != '[object Object]' && !$.isNumeric(DataArr[q])) {
                                    Queries.push(DataArr[q]);
                                }
                            }
                            if (0 < Queries.length) {
                                Response(Queries);
                            }
                        }
                    }
                });
            },
            delay: 1000,
            minLength: 2
        });
    });
