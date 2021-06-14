<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" :width="width" :height="height"><g stroke-miterlimit="10" transform="translate(0.5, 0.5)" :fill="_secondaryfill" :stroke="_secondaryfill"><path fill="none" stroke-width="1" stroke-linecap="square" d="M2,58h4 c2.2,0,4-1.8,4-4v-4l-4.8-2.4c-2.9-1.5-2.9-5.7,0-7.2L10,38v-4l7.2-2.9c1.3-0.5,1.7-2.3,0.7-3.3L10,20V6" stroke-linejoin="miter" :stroke="_secondaryfill"></path> <path fill="none" stroke-width="1" stroke-linecap="square" d="M20,46l8-10V18 c0-3.3,2.7-6,6-6h22c3.3,0,6,2.7,6,6v22c0,3.3-2.7,6-6,6H20z" stroke-linejoin="miter" :stroke="fill"></path> <line fill="none" stroke-width="1" stroke-linecap="square" x1="38" y1="24" x2="52" y2="24" stroke-linejoin="miter" :stroke="fill"></line> <line fill="none" stroke-width="1" stroke-linecap="square" x1="38" y1="34" x2="52" y2="34" stroke-linejoin="miter" :stroke="fill"></line></g></svg></template>

<script>
export default {
	props: {
		width: {
			type: [Number, String],
			default: "100%"
		},
		height: {
			type: [Number, String],
			default: "100%"
		},
		fill: {
			type: String,
			default: "currentColor"
		},
		secondaryfill: {
			type: String
		}
	},
	computed: {
		_secondaryfill: function () {
			return this.secondaryfill || this.fill
		}
	}
}
</script>