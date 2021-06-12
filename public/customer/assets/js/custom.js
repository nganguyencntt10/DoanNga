const View = {
    service:{
        get(){
            var service_list = [];
            $('.services_id').each(function( index ) {
                service_list.push($( this ).val());
            });
            return service_list;
        },
        create(data){
            $('.booking-fee').append( `
                <li>${data.name}<span>${data.prices.replace(/\B(?=(\d{3})+(?!\d))/g, ',')} đ</span></li>
           `)
        },
    }
};
(() => {
    function getServiceData(){
        View.service.get().map(v => {
            Api.ServicesProcedure.Get(v)
                .done(res => {
                    View.service.create(res);
                })
                .fail(err => {
                    console.log(err);
                    View.helper.showToastError('Error', 'Something Wrong'); 
                })
                .always(() => {
                });
        })
    }
    getServiceData()
})();
