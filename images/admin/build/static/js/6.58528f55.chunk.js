(this["webpackJsonpadmin-ciutat_agora"]=this["webpackJsonpadmin-ciutat_agora"]||[]).push([[6],{515:function(e,t,n){"use strict";n.r(t);var r=n(2),a=n(70),o=n(4),i=n(56),s=n(303),c=n(438),l=n(0),u=Object(a.observer)((function(e){var t=e.filtre;return Object(l.jsx)(l.Fragment,{children:Object(l.jsx)(c.Fields.Input,{name:"text",label:"Tema",startIcon:Object(l.jsx)(s.a,{}),onChange:function(e){var n=e.target,r=n.name,a=n.value;t.setCerca(Object(i.a)(Object(i.a)({},t.cerca),{},Object(o.a)({},r,a)))}})})})),b=Object(a.observer)((function(e){var t=e.state,n=e.filtre;r.useEffect((function(){n.setObjs(t.objs)}),[t.objs,n]);var a=n.getItems().map((function(e,n){return{titol:e.tema,onClick:function(){return t.onEdit(e)},onEdit:function(){return t.onEdit(e)},onDelete:function(){return t.onDel(e)}}}));return Object(l.jsx)(c.WebLlistat,{header:Object(l.jsx)(u,{filtre:n}),footer:Object(l.jsx)(c.WebPaginacio,{filtres:n}),items:a})})),j=n(319),d=Object(a.observer)((function(e){var t=e.state,n=t.objSel;return Object(l.jsx)(c.WebDialog,{open:t.openPopup,titol:"Temes",descripcio:"Editar o afegit temes",onSave:t.onSave,onClose:t.onClose,fullscreen:!0,children:Object(l.jsxs)(c.WebForm,{children:[Object(l.jsx)(c.Fields.Input,{name:"id",required:!0,label:"Id",value:n.id,onChange:t.onChange,onBlur:t.validateSingleError,disabled:!0,xs:3,textError:t.errors.id}),Object(l.jsx)(c.Fields.Input,{name:"tema",required:!0,label:"Tema",value:n.tema,onChange:t.onChange,onBlur:t.validateSingleError,flexGrow:!0,textError:t.errors.tema})]})})}));t.default=function(){var e=r.useContext(j.appState).temesState;r.useEffect((function(){e.onLoad()}));var t=new c.FilterState;return t.setRowsPerPage(10),t.setFilter(e.cercarGenerica),Object(l.jsxs)(c.WebPant,{titol:"Temes",onAdd:function(){return e.onAdd()},tipusAdd:"action",children:[Object(l.jsx)(b,{state:e,filtre:t}),Object(l.jsx)(d,{state:e})]})}}}]);