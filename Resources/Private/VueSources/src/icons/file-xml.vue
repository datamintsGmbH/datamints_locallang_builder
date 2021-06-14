<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" :width="width" :height="height"><g :fill="fill"><path fill="none" stroke-width="1" stroke-miterlimit="10" stroke-linejoin="miter" stroke-linecap="butt" d="M12.6 0.63v5.04h5.04" :stroke="fill"></path><path fill="none" stroke-width="1" stroke-linecap="square" stroke-miterlimit="10" stroke-linejoin="miter" d="M17.64 8.19v-2.52l-5.04-5.04h-10.08v7.56" :stroke="fill"></path><path fill="none" stroke-width="1" stroke-linecap="square" stroke-miterlimit="10" stroke-linejoin="miter" d="M2.52 17.01v2.52h15.12v-2.52" :stroke="fill"></path><path d="M8 14.49h-1.13l-0.7-1.13-0.69 1.13h-1.13l1.19-1.83-1.13-1.76h1.07l0.63 1.13 0.63-1.13h1.13l-1.13 1.83 1.26 1.76z" stroke-linejoin="miter" :fill="_secondaryfill"></path><path d="M9.95 14.49l-0.75-2.58c0.06 0.44 0.06 0.76 0.06 1.01v1.57h-0.88v-3.59h1.32l0.76 2.58 0.75-2.58h1.33v3.59h-0.88v-1.57-0.26c0-0.06 0-0.32 0.06-0.75l-0.82 2.58h-0.95z" stroke-linejoin="miter" :fill="_secondaryfill"></path><path d="M13.23 14.49v-3.59h0.95v2.83h1.38v0.76h-2.33z" stroke-linejoin="miter" :fill="_secondaryfill"></path><path fill="none" stroke-width="1" stroke-linecap="square" stroke-miterlimit="10" stroke-linejoin="miter" d="M0.63 8.19h18.9v8.82h-18.9z" :stroke="fill"></path></g></svg></template>

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