(function () {
    const search = instantsearch({
        appId: 'YI1NJR2OIJ',
        apiKey: 'c48ff855e8adad20d82b6f3b04b726bc',
        indexName: 'products',
        urlSync: true
    });

    search.addWidget(
        instantsearch.widgets.hits({
            container: '#hits',
            templates: {
                empty: 'Ничего не найдено',
                item: function (item) {
                    return `
<div class="products-col">

<div class="products-col-img">
                                                            <a href="${window.location.origin}/catalog/${item.slug}">
                                    <img src="${window.location.origin}/storage/${item.image}" alt="img" class="algolia-thumb-result">

                                </div>
                               
<section class="products-col-text"><h5>
${item._highlightResult.name.value}
</h5></section>
`;
                }
            }
        })
    );

    // initialize SearchBox
    search.addWidget(
        instantsearch.widgets.searchBox({
            container: '#search-box',
            placeholder: 'Искать'
        })
    );

    // initialize pagination
    search.addWidget(
        instantsearch.widgets.pagination({
            container: '#pagination',
            maxPages: 2,
            // default is to scroll to 'body', here we disable this behavior
            scrollTo: false
        })
    );

    search.addWidget(
        instantsearch.widgets.stats({
            container: '#stats-container'
        })
    );

    search.start();
})();