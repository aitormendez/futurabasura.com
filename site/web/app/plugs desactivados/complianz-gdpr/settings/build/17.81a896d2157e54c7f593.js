"use strict";(globalThis.webpackChunkcomplianz_gdpr=globalThis.webpackChunkcomplianz_gdpr||[]).push([[17,8414,5207],{90017:(e,t,n)=>{n.r(t),n.d(t,{default:()=>s});var c=n(86087),a=n(5207),o=n(27723),i=n(4219),l=n(38414);const s=(0,c.memo)((()=>{const{savedDocument:e,conclusions:t}=(0,a.default)(),{addHelpNotice:n}=(0,i.default)();return(0,c.useEffect)((()=>{e.has_to_be_reported&&n("create-data-breach-reports","warning",(0,o.__)("This wizard is intended to provide a general guide to a possible data breach.","complianz-gdpr")+" "+(0,o.__)("Specialist legal advice should be sought about your specific circumstances.","complianz-gdpr"),(0,o.__)("Specialist legal advice required","complianz-gdpr"),!1)}),[e]),(0,c.createElement)(c.Fragment,null,(0,c.createElement)("div",{id:"cmplz-conclusion"},(0,c.createElement)("h3",null,(0,o.__)("Your dataleak report:","complianz-gdpr")),(0,c.createElement)("ul",{className:"cmplz-conclusion__list"},t.length>0&&t.map(((e,t)=>(0,c.createElement)(l.default,{conclusion:e,key:t,delay:1e3*t}))))))}))},38414:(e,t,n)=>{n.r(t),n.d(t,{default:()=>l});var c=n(86087),a=n(45111),o=n(42838),i=n.n(o);const l=(0,c.memo)((({conclusion:e,delay:t})=>{const[n,o]=(0,c.useState)(!0);(0,c.useEffect)((()=>{setTimeout((()=>{l()}),t)}));const l=()=>{o(!1)};let s="green";return"warning"===e.report_status&&(s="orange"),"error"===e.report_status&&(s="red"),(0,c.createElement)(c.Fragment,null,n&&(0,c.createElement)("li",{className:"cmplz-conclusion__check icon-loading"},(0,c.createElement)(a.default,{name:"loading",color:"grey"}),(0,c.createElement)("div",{className:"cmplz-conclusion__check--report-text"}," ",e.check_text," ")),!n&&(0,c.createElement)("li",{className:"cmplz-conclusion__check icon-"+e.report_status},(0,c.createElement)(a.default,{name:e.report_status,color:s}),(0,c.createElement)("div",{className:"cmplz-conclusion__check--report-text",dangerouslySetInnerHTML:{__html:i().sanitize(e.report_text)}}," ")))}))},5207:(e,t,n)=>{n.r(t),n.d(t,{default:()=>l});var c=n(81621),a=n(16535),o=n(9588),i=n(73710);const l=(0,c.vt)(((e,t)=>({documentsLoaded:!1,savedDocument:{},conclusions:[],region:"",fileName:"",fetching:!1,updating:!1,loadingFields:!1,documents:[],regions:[],fields:[],editDocumentId:!1,resetEditDocumentId:t=>{e({editDocumentId:!1,region:""})},editDocument:async t=>{e({updating:!0}),await o.doAction("load_databreach_report",{id:t}).then((t=>{e({fields:t.fields,region:t.region,updating:!1,fileName:t.file_name})})).catch((e=>{console.error(e)})),e({editDocumentId:t})},setRegion:t=>{e({region:t})},updateField:(n,c)=>{let o=!1,l=!1;e((0,a.Ay)((e=>{e.fields.forEach((function(e,t){e.id===n&&(l=t,o=!0)})),!1!==l&&(e.fields[l].value=c)})));let s=(0,i.updateFieldsListWithConditions)(t().fields);e({fields:s})},save:async n=>{e({updating:!0});let c=t().editDocumentId,a=0;await o.doAction("save_databreach_report",{fields:t().fields,region:n,post_id:c}).then((t=>(a=t.post_id,e({updating:!1,conclusions:t.conclusions}),t))).catch((e=>{console.error(e)})),await t().fetchData();let i=t().documents.filter((e=>e.id===a));i.length>0&&e({savedDocument:i[0]})},deleteDocuments:async n=>{let c=t().documents.filter((e=>n.includes(e.id)));e((e=>({documents:e.documents.filter((e=>!n.includes(e.id)))})));let a={};a.documents=c,await o.doAction("delete_databreach_report",a).then((e=>e)).catch((e=>{console.error(e)}))},fetchData:async()=>{if(t().fetching)return;e({fetching:!0});const{documents:n,regions:c}=await o.doAction("get_databreach_reports",{}).then((e=>e)).catch((e=>{console.error(e)}));e((e=>({documentsLoaded:!0,documents:n,regions:c,fetching:!1})))},fetchFields:async t=>{let n={region:t};e({loadingFields:!0});const{fields:c}=await o.doAction("get_databreach_report_fields",n).then((e=>e)).catch((e=>{console.error(e)}));let a=(0,i.updateFieldsListWithConditions)(c);e((e=>({fields:a,loadingFields:!1})))}})))}}]);