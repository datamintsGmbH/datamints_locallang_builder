<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" :width="width" :height="height"><g stroke-miterlimit="10" :fill="_secondaryfill" :stroke="_secondaryfill"><path fill="none" stroke-linecap="round" stroke-linejoin="round" d="M1.5,7.5 c0-3.866,3.134-7,7-7c2.636,0,4.828,1.641,6,4" :stroke="fill"></path> <polyline fill="none" stroke-linecap="round" stroke-linejoin="round" points="14.5,0.5 14.5,4.5 10.5,4.5 " :stroke="fill"></polyline> <path fill="none" stroke-linecap="round" stroke-linejoin="round" d="M15.5,8.5 c0,3.866-3.134,7-7,7c-2.636,0-4.828-1.641-6-4" :stroke="_secondaryfill"></path> <polyline fill="none" stroke-linecap="round" stroke-linejoin="round" points="2.5,15.5 2.5,11.5 6.5,11.5 " :stroke="_secondaryfill"></polyline></g></svg></template>

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