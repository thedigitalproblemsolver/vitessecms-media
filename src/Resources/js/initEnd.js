for (const init of inits) {
    if (typeof init === 'object') {
        init.init();
    } else {
        init();
    }
}