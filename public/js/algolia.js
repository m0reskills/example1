(function() {
    const client = algoliasearch('YI1NJR2OIJ', 'c48ff855e8adad20d82b6f3b04b726bc');
    const index = client.initIndex('products');
    let enterButton = true;
    //initialize autocomplete on search input (ID selector must match)
    autocomplete('#aa-search-input',
        { hint: false }, {
            source: autocomplete.sources.hits(index, { hitsPerPage: 10 }),
            //value to be displayed in input control after user's suggestion selection
            displayKey: 'name',
            //hash of templates used when rendering dataset
            templates: {
                //'suggestion' templating function used to render a single suggestion
                suggestion: function (suggestion) {
                    const markup = `
                        <div class="algolia-result">
                            <span>
                                <img src="${window.location.origin}/storage/${suggestion.image}" alt="img" class="algolia-thumb">
                                ${suggestion._highlightResult.name.value}
                            </span>
                        </div>
                    `;

                    return markup;
                },
                empty: function (result) {
                    return 'Не нашлось результатов по "' + result.query + '"';
                }
            }
        }).on('autocomplete:selected', function (event, suggestion, dataset) {
        window.location.href = window.location.origin + '/catalog/' + suggestion.slug;
        enterButton = true;
    }).on('keyup', function(event) {
        if (event.keyCode === 13 && !enterButton) {
            event.preventDefault();
        }
    });
})();
