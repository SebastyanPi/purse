const MESES = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];

const CARTERA = {
  all: function(){
    return AJAX("/purse/all",'POST',$("#purseAll").serialize());
  },
  edit:function(){
    return AJAX("/purse/edit",'POST',$("#FormPurseEdit").serialize());
  },
  history:function(){
    return AJAX("/history/search",'POST',$("#FormPurseHistory1").serialize());
  },
  delete:function(){
    return AJAX("/history/delete",'POST',$("#ModalPasswordAdmin").serialize());
  },
  suma:function(){
    return AJAX("/purse/total",'POST',$("#FormRequestOtros").serialize());
  }
}

const ENTRY = {
  all:function(){
    return AJAX("/entry/all",'POST',$("#FormRequestOtros").serialize());
  },
  create:function(){
    return this.createForm("#formEntry");
  },
  createForm:function(nameForm){
    return AJAX("/entry/store",'POST',$(nameForm).serialize());
  }
}

const OtherENTRIES = {
  all:function(){
    return AJAX("/other/all",'POST',$("#FormRequestOtros").serialize());
  },
  create:function(){
    return this.createForm("#formEntry1");
  },
  createForm:function(nameForm){
    return AJAX("/other/entry/store",'POST',$(nameForm).serialize());
  }
}

const thirdEntry = {
  add:function(){
    return AJAX("/third/entry/add", 'POST', $("#addThirdEntry").serialize());
  },
  addActivity:function(){
    return AJAX("/third/activity/add",'POST',$("#formAddThirdActivity").serialize());
  },
  listActivity:function(){
    return AJAX("/third/activity/",'GET',$("#formAddThirdActivity").serialize());
  },
  search:function(name){
    return AJAX("/third/search/"+name, 'GET', { id: '1'});
  }

}

const ESTUDIANTE = {
  search:function(name){
    return AJAX("/student/search/"+name, 'GET', {});
  },
  searchAll:function(name){
    return AJAX("/student/search/all/"+name, 'GET', {});
  }
}

const Synchronization = {
  count:function(){
    return AJAX("/synchronization/count/local-cloud",'POST',$("#formEntry").serialize());
  }
}


const AJAX =  function(url,method,data){
  return $.ajax({
    url: url,
    method: method,
    data: data
  });
}

const ApppendTo = function (hijos,padre){
  for (let index = 0; index < hijos.length; index++) {
    hijos[index].appendTo(padre);
  }
}

const BucarIndice  = function (nombre){
  var fecha = 0;
  for (let index = 0; index < MESES.length; index++) {
    if(MESES[index] == nombre){
      fecha = index+1;
      if(fecha < 10){
        fecha = "0"+fecha;
      }
      return fecha;
    }
  }
}
