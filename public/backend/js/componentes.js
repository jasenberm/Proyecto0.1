Vue.component("box", {
    props: ["title", "refresh", "close", "color"],
    methods: {
        closeClick() {
            // window[this.close]();
        },
        refreshClick() {
            if (_.isString(this.refresh))
                if (_.isFunction(window[this.refresh])) window[this.refresh]();
                else
                    throw new TypeError(
                        "No existe la funcion -> " +
                            JSON.stringify(this.refresh)
                    );
        }
    },
    mounted() {},
    template: `
    <div :class="'box box-'+(color ? color : 'primary')">
      <div class="box-header with-border">
        <div class="box-title" v-html="title"></div>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" @click="refreshClick" type="button" v-if="refresh">
            <i class="fa fa-refresh" data-togle="tooltip" title="Refrescar"></i>
          </button>
          <button class="btn btn-box-tool" data-widget="collapse" @click="closeClick" type="button" v-if="close">
            <i class="fa fa-times" data-togle="tooltip" title="minimizar"></i>
          </button>
        </div>
      </div>
      
      <div class="box-body">
        <slot></slot>
      </div>
      
      <div class="box-footer">
        <slot name="footer">
        
        </slot>
      </div>
    </div>
  `
});
// =============================================================================================================================

Vue.component("box-fluid", {
    props: {
        title: {
            type: String,
            default: ""
        },
        controlsShow: {
            type: String,
            default: false
        },
        color: {
            type: String,
            default: "success"
        }
    },
    data: function() {
        return {
            controlClose: false,
            controlRefresh: false
        };
    },
    methods: {
        closeClick() {
            this.$emit("close");
        },
        refreshClick() {
            this.$emit("refresh");
        }
    },
    mounted() {
        if (this.controlsShow !== false && this.controlsShow == "") {
            this.controlRefresh = this.controlClose = true;
        } else if (this.controlsShow !== false && this.controlsShow !== "") {
            let control = this.controlsShow.split("-");
            let app = this;
            control.forEach(function(v) {
                if (v === "close") {
                    app.controlClose = true;
                } else if (v === "refresh") {
                    app.controlRefresh = true;
                }
            });
        }
    },
    template: `
    <div :class="'box box-'+(color ? color : 'primary')">
      <div class="box-header with-border">
        <div class="box-title" v-html="title"></div>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" @click="refreshClick" type="button" v-if="controlRefresh">
            <i class="fa fa-refresh" data-togle="tooltip" title="Refrescar"></i>
          </button>
          <button class="btn btn-box-tool" data-widget="collapse" @click="closeClick" type="button" v-if="controlClose">
            <i class="fa fa-times" data-togle="tooltip" title="minimizar"></i>
          </button>
        </div>
      </div>
      
        <div class="box-body">
            <div class="content-fluid">
                <slot></slot>
            </div>
      </div>
      
      <div class="box-footer">
        <slot name="footer">
        
        </slot>
      </div>
    </div>
  `
});

// =============================================================================================================================
/*Vue.component('v-input-excel', {

});*/

Vue.component("v-input-img", {
    props: {
        id: false,
        title: { type: String, default: "Upload file" },
        tooltip: "",
        name: false,
        validate: "",
        icon: false,
        type: { type: String, default: "file" },
        multiple: { type: Boolean, default: true },
        accept: { type: String, default: "image/x-png,image/gif,image/jpeg" },
        length: { type: Number, default: 1 },
        height: { type: String, default: "100px" },
        width: { type: String, default: "100px" },
        color: { type: String, default: "green" },
        "border-radius": { type: String, default: "10%" }
    },
    data: function() {
        return {
            images: [],
            spinner: ""
        };
    },
    computed: {
        getStyleImage() {
            return (
                "width:" +
                this.width +
                ";height:" +
                this.height +
                ";background:" +
                this.color +
                ";border-radius:" +
                this.borderRadius
            );
        },
        getStyleSpan() {
            return (
                "left:" +
                this.width.substring(0, this.width.length - 2) / 2 +
                "px"
            );
        }
    },
    methods: {
        previewFiles(event) {
            var app = this;
            var files = event.target.files;
            //console.log(files);
            if (files.length > this.length) {
                return alert(
                    "Solo se permiten hasta " + this.length + " imagen"
                );
                // return mensajeAlert({type:'e',html:'Solo se permiten hasta 6 imagenes'});
                // return toastAlert({type:'e',html:'Solo se permiten hasta 6 imagenes'});
            }
            if (files[0].type.match("image.*")) {
                app.images = [];
                var rutaTem = "";
                for (var i = 0, f; (f = files[i]); i++) {
                    app.spinner = "fa fa-spinner fa-pulse fa-3x";
                    if (f.type.match("image.*")) {
                        var reader = new FileReader();
                        reader.onload = (function(fileItem) {
                            return function(e) {
                                // Insertamos la imagen
                                rutaTem = e.target.result;
                                app.images.push({
                                    src: rutaTem,
                                    title: fileItem.name,
                                    size: parseInt(fileItem.size / 1024) + " KB"
                                });
                                app.spinner = "";
                            };
                        })(f);
                        reader.readAsDataURL(f);
                    }
                }
                //  emite las imagenes cuando se utilice v-model
                this.$emit("input", app.images);
            } else {
                alert("Formato de fichero no permitido");
            }
        }
    },
    template: `
        <div>
            <div class="form-group">
                <label id="input-label" class="btn btn-sm btn-success input-label" v-html="title" :for="id"><span id="input-label"></span>
                </label>
                <input 
                    style="display: none;"
                    @change="previewFiles"
                    :multiple="multiple"
                    :id="id"
                    :name="id"
                    :type="type"
                    :accept="accept"/>
                
            </div>
            <div class="imgTemp">
                <div class="row-fluid">
                    <div v-for="image in images" class="col-md-4">
                    <img :src="image.src" :alt="image.alt" :style="'vertical-align:middle;padding:2px;margin:2px;padding-bottom:20px;' + getStyleImage" :title="image.title">
                    <span v-html="image.size" :style="'position:absolute;z-index:1;top:84%;color:white;'+getStyleSpan"></span>
                    </div>
                </div>
            </div>
            <span><i :class="spinner"></i></span>
        </div>
    `
});

// =============================================================================================================================

Vue.component("v-input", {
    // props:['nombre', 'config', 'valor', 'show', 'clase', 'desactivar', 'tipo' , 'icon','readonly','value'],
    props: {
        id: false,
        title: false,
        tooltip: "",
        name: false,
        validate: "",
        placeholder: "",
        icon: false,
        clase: false,
        desactivar: false,
        readonly: false,
        value: "",
        type: "text"
    },
    created() {
        console.log("::::: " + this.id);
        console.log("::::: " + this.idRandom);
    },
    data: function() {
        return {
            idRandom: Math.floor(Math.random() * 10000 + 1)
        };
    },
    computed: {
        getName() {
            var result = "";
            if (this.id && this.name == undefined) {
                result = this.id;
            } else if (this.name) {
                result = this.name;
            } else {
                result = this.idRandom;
            }
            return result;
        }
    },
    template: `
    <div>
      <div class="form-group">
        <label v-if="title" v-html="title"></label>
        <div class="input-group">
          <div class="input-group-addon" v-if="icon">
              <i :class="'fa ' + ((icon) ? icon : 'fa-calendar') "></i>
          </div>
          <input
            :title="tooltip"
            :disabled="desactivar ? true : false"
            :readonly="readonly ? true : false"
            :type="type"
            :id="'txt_' + (id ? id : idRandom)"
            ref="'txt_' + (id ? id : idRandom)"
            :name="'txt_' + getName"
            v-bind:value="value"
            v-on:input="$emit('input', $event.target.value)"
            :validacion="validate"
            :placeholder = "placeholder"
            :class="((type !== 'file') ? 'form-control ' : '' ) + (clase ? clase : '')"
          />
          <div :id="'txt_' + (id ? id : idRandom) + '_info'" class="input-group-addon" style="border: 0px"></div>
        </div>
      </div>
    </div>
  ` /*,

  data : function() {
    return {
      txt : ''
    }
  },*/
});

// =============================================================================================================================

Vue.component("txt", {
    props: [
        "nombre",
        "config",
        "valor",
        "show",
        "clase",
        "desactivar",
        "tipo",
        "icon",
        "readonly",
        "value"
    ],
    template: `
    <div class="input-group">
      <div class="input-group-addon" v-if="icon">
          <i :class="'fa ' + ((icon) ? icon : 'fa-calendar') "></i>
      </div>
      <input
        :disabled="desactivar ? true : false"
        :readonly="readonly ? true : false"
        :type="tipo ? tipo : 'text'"
        :id="'txt_' + (nombre ? nombre : '')"
        ref="'txt_' + (nombre ? nombre : '')"
        :name="'txt_' + (nombre ? nombre : '')"
        v-bind:value="value"
        v-on:input="$emit('input', $event.target.value)"
        :validacion="config"
        :placeholder = "(show ? show : '')"
        :class="((tipo !== 'file') ? 'form-control ' : '' ) + (clase ? clase : '')"
      />
      <div :id="'txt_' + (nombre ? nombre : '') + '_info'" class="input-group-addon" style="border: 0px"></div>
    </div>
  ` /*,
  data : function() {
    return {
      txt : ''
    }
  },*/
});

// =============================================================================================================================

Vue.component("leaflet-map", {
    props: {
        id: {
            type: String,
            default: "leaflet"
        },
        height: {
            type: String,
            default: "250px"
        },
        width: {
            type: String,
            default: "auto"
        },
        zoom: {
            type: Number,
            default: 13
        },
        clickable: {
            type: Boolean,
            default: false
        },
        "clickable-show": {
            type: Boolean,
            default: false
        },
        center: {
            type: Array,
            default: null
        },
        marker: {
            type: Object,
            default: { latlng: { lat: -2.190723, lng: -79.886398 } }
        },
        "marker-watch": {
            type: Object,
            default: { latlng: { lat: -2.190723, lng: -79.886398 } }
        },
        invalidateSize: {
            type: Boolean,
            default: false
        }
    },
    template: `
        <div @click="update('click',null)"
            :id="id"
            :style="'height: '+ this.height + '; width: ' + this.width + '; position: relative; outline: none;'"
            >
        </div>
    `,
    data: function() {
        return {
            map: null,
            mmr: null,
            methods: null
        };
    },
    mounted() {
        let app = this;
        if (this.center == null) {
            this.center = [this.marker.latlng.lat, this.marker.latlng.lng];
        }
        this.map = L.map(this.id).setView(this.center, this.zoom);
        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            minZoom: 5,
            maxZoom: 19,
            attribution:
                '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            id: "mapbox.satellite"
        }).addTo(this.map);
        this.mmr = L.marker([0, 0]);
        this.mmr.bindPopup("0,0", { autoClose: false });
        this.mmr.addTo(this.map);
        /** **/
        /** Para el evento click sobre el mapa **/
        this.addClickEvent();
        /** all methods **/
        //app.$data.methods = app.$options.methods;
        /** **/
        //if(app.marker){
        this.buscarCoordenadas(this.marker.latlng, this.zoom);
        //}
        /*
          setTimeout(function() {
            app.map.invalidateSize(true);
          },10);
        */
    },
    methods: {
        buscarCoordenadas(latlng, zoom = this.zoom, instance) {
            if (instance != null) {
                this.map = instance.map;
                this.mmr = instance.mmr;
            }
            this.mmr.setLatLng([latlng.lat, latlng.lng]);
            this.map.setView([latlng.lat, latlng.lng], zoom);
            if (this.clickableShow) {
                this.show(latlng);
            }
        },
        addClickEvent() {
            if (this.clickable || this.clickableShow) {
                let app = this;
                this.map.on("click", function(e) {
                    app.mmr.setLatLng(e.latlng);
                    if (app.clickableShow) {
                        app.show(e.latlng);
                    }
                    /** **/
                    if (app.invalidateSize) {
                        app.map.invalidateSize();
                    }
                    /** **/
                    app.update("input", e.latlng);
                });
            }
        },
        update(type, v) {
            if (v == null) {
                this.$emit(type, this);
            } else {
                this.$emit(type, v);
            }
        },
        show(latlng, zoom = this.zoom) {
            let app = this;
            $(
                "#" +
                    this.$el.id +
                    " img.leaflet-marker-icon, #" +
                    this.$el.id +
                    " img.leaflet-marker-shadow"
            ).remove();
            L.marker([latlng.lat, latlng.lng]).addTo(this.map);
            let popup =
                "<b class='text-danger'>" +
                Number(latlng.lat).toFixed(6) +
                "</b>, " +
                Number(latlng.lng).toFixed(6);
            if (latlng.title != undefined) {
                popup = latlng.title;
            }
            console.log("latlng.title: " + latlng.title);
            this.mmr.setPopupContent(popup, { autoClose: false }).openPopup();
        }
    },
    watch: {
        markerWatch: {
            handler: function(val) {
                if (this.invalidateSize) {
                    this.map.invalidateSize();
                }
                console.log("componente marker watch: " + val.latlng);
                this.mmr.setLatLng([val.latlng.lat, val.latlng.lng]);
                this.show(val.latlng);
                // this.map.setView([val.latlng.lat,val.latlng.lng], 13);
                this.map.setView([val.latlng.lat, val.latlng.lng], this.zoom);
            },
            deep: true
        }
    }
});

// =============================================================================================================================

Vue.component("date-picker", {
    props: {
        id: {
            type: String,
            default: ""
        },
        validate: {
            type: String,
            default: ""
        },
        placeholder: "",
        icon: {
            type: String,
            default: false
        },
        readonly: {
            type: Boolean,
            default: false
        },
        value: {
            type: String,
            default: ""
        },
        type: {
            type: String,
            default: ""
        }
    },
    methods: {
        update(v) {
            this.$emit("input", v);
        }
    },
    template: `<div class="input-group">
      <div class="input-group-addon" v-if="icon">
          <i :class="'fa ' + ((icon) ? icon : 'fa-calendar') "></i>
      </div>
        <input 
        :id="'txt_' + (id ? id : '')"
        ref="'txt_' + (id ? id : '')"
        :readonly="readonly ? true : false"
        :name="'txt_' + (id ? id : '')"
        :placeholder="placeholder"
        :validacion="validate" type="text" v-datepicker :class="'datepickerr form-control '" :value="value">
        <div :id="'txt_' + (id ? id : '') + '_info'" class="input-group-addon" style="border: 0px"></div>
      </div>`,
    directives: {
        datepicker: {
            inserted(el, binding, vNode) {
                $(el)
                    .datepicker({
                        format: "yyyy-mm-dd",
                        autoclose: true,
                        todayHighlight: true,
                        language: "es"
                    })
                    .on("changeDate", function(e) {
                        vNode.context.$emit("input", e.format(0));
                    });
                //textBoxFecha();
                /*$(el).datepicker({
                    autoclose: true,
                    format: 'yyyy-mm-dd',
                    language: 'es',
                    todayHighlight: true
                }).on('changeDate',function(e){
                    vNode.context.$emit('input', e.format(0))
                })*/
            }
        }
    }
});

// =============================================================================================================================

Vue.component("textbox", {
    props: ["nombre", "info", "validacion", "valor", "ph"],
    template: `
    <div class="input-group">
      <input 
        type="text" 
        :id=nombre 
        :name=nombre 
        :validacion=validacion
        class="form-control"
        :value = valor
        :placeholder = ph
      />
      <div :id=info class="input-group-addon" style="border: 0px"></div>
    </div>
  `,
    data: function() {
        return {
            textbox: ""
        };
    }
});

// =============================================================================================================================

Vue.component("textboxclase", {
    props: ["nombre", "info", "validacion", "clase", "valor", "ph"],
    template: `
    <div class="input-group">
      <input 
        type="text" 
        v-model="textbox" 
        :id=nombre 
        :name=nombre 
        :validacion=validacion
        :class=clase
        :placeholder = ph
      />
      <div :id=info class="input-group-addon" style="border: 0px"></div>
    </div>
  `,
    data: function() {
        return {
            textbox: ""
        };
    }
});

// =============================================================================================================================

Vue.component("v-textarea", {
    // props:['nombre', 'info', 'validacion','filas'],
    props: {
        id: false,
        validate: "",
        rows: false,
        title: "",
        tooltip: ""
    },
    template: `<div>
        <div class="form-group">
            <label v-html="title"></label>
            <div class="input-group">
                <textarea :title="tooltip" v-on:input="$emit('input', $event.target.value)" :id="id" :name="id" class="form-control" :rows="rows" :max-rows="rows" :validacion="validate"></textarea>    
                <div :id="id + '_info'" class="input-group-addon" style="border: 0px"></div>
            </div>
        </div>
  </div>
  `,
    data: function() {
        return {};
    }
});

// =============================================================================================================================

Vue.component("v-select", {
    // props:['nombre', 'info', 'validacion', 'url'],
    props: {
        id: false,
        validate: "",
        url: false,
        data: {
            type: Array,
            default: false
        },
        title: "",
        tooltip: ""
    },
    template: `
  <div class="form-group">
    <label v-html="title"></label>
    <div class="input-group">
      <select @input="$emit('input', $event.target.value)" :title="tooltip" :id=id :name=id :validacion=validate v-model="selected" class="form-control select2" style="width:100%">
        <option value=0 selected disabled>Seleccione</option>
        <option v-for="option in options" :value="option.key"> {{option.value}}</option>
      </select>
      <div :id="id + '_info'" class="input-group-addon" style="border: 0px"></div>
    </div>
  </div>
  `,
    data: function() {
        return {
            selected: 0,
            options: []
        };
    },
    mounted() {
        var a = this.data;
        console.log("dataaaaaaaaaaa", a);
        if (a.length > 0) {
            /*console.log(a,'antes');
        a = a.replace(/'/g, '"');
        a = JSON.parse(a);
        console.log(a,'despues');*/
        }
        //console.log(this.url);
        if (this.url) {
            axios.get(this.url).then(response => {
                this.options = response.data;
            });
        } else if (this.data) {
            this.options = a;
        }
    }
});

// =============================================================================================================================

Vue.component("combo", {
    props: ["nombre", "info", "validacion", "url"],
    template: `
    <div class="input-group">
      <select :id=nombre :name=nombre :validacion=validacion v-model="selected" class="form-control select2" style="width:100%">
        <option value=0 selected="true">Seleccione</option>
        <option v-for="option in options" :value="option.valor"> {{option.descripcion}}</option>
      </select>
      <div :id=info class="input-group-addon" style="border: 0px"></div>
    </div>
  `,
    data: function() {
        return {
            selected: "",
            options: []
        };
    },
    mounted() {
        //console.log(this.url);
        if (this.url) {
            axios.get(this.url).then(response => {
                this.options = response.data;
            });
        }
    }
});

// combo con opcion todos

Vue.component("combo-t", {
    props: ["nombre", "info", "validacion", "url"],
    template: `
    <div class="input-group">
      <select :id=nombre :name=nombre :validacion=validacion v-model="selected" class="form-control select2" style="width:100%">
        <option selected="selected">Seleccione</option>
        <option value=0>Todos</option>
        <option v-for="option in options" :value="option.valor"> {{option.descripcion}}</option>
      </select>
      <div :id=info class="input-group-addon" style="border: 0px"></div>
    </div>
  `,
    data: function() {
        return {
            selected: "",
            options: []
        };
    },
    mounted() {
        //console.log(this.url);
        axios.get(this.url).then(response => {
            this.options = response.data;
        });
    }
});

// =============================================================================================================================

Vue.component("check", {
    props: ["nombre"],
    template: `<input type="checkbox" :id=nombre :name=nombre>`
});

// =============================================================================================================================

Vue.component("list-check", {
    props: ["nombre", "info", "validacion", "url"],
    template: `
    <div class="input-group" > 
      <div :id=nombre :name=nombre :validacion=validacion class="form-group col-xs-12 checkbox">
        <div v-for="option in options">
          <input type="checkbox" :id=option.valor :name=option.valor>{{ option.descripcion }}
        </div>
      </div>
      <div :id=info class="input-group-addon" style="border: 0px"></div>
    </div>
  `,
    data: function() {
        return {
            options: []
        };
    },
    mounted() {
        if (this.url) {
            axios.get(this.url).then(response => {
                this.options = response.data;
            });
        }
    }
});
