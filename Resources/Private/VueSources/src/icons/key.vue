<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" :width="width" :height="height"><g stroke-miterlimit="10" transform="translate(0.5, 0.5)" :fill="_secondaryfill" :stroke="_secondaryfill"><path fill="none" stroke-width="1" stroke-linecap="square" d="M18,1L9.766,9.234 C9.201,9.086,8.611,9,8,9c-3.866,0-7,3.134-7,7c0,3.866,3.134,7,7,7s7-3.134,7-7c0-0.891-0.173-1.74-0.476-2.524L17,11V8h3l3-3V1H18 z" stroke-linejoin="miter" :stroke="fill"></path> <circle fill="none" stroke-width="1" stroke-linecap="square" cx="8" cy="16" r="2" stroke-linejoin="miter" :stroke="_secondaryfill"></circle></g></svg></template>

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