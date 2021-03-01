Nova.booting((Vue, router, store) => {
	
  router.addRoutes([
    {
      name: 'urldesk',
      path: '/urldesk',
      component: require('./components/Tool'),
    },
  ])

  var filter = function(text, length, clamp){
      clamp = clamp || '...';
      var node = document.createElement('div');
      node.innerHTML = text;
      var content = node.textContent;
      return content.length > length ? content.slice(0, length) + clamp : content;
  };
  Vue.filter('truncate', filter);

})



