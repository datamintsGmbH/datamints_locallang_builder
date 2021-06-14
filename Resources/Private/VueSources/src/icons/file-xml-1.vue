<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" :width="width" :height="height"><g stroke-miterlimit="10" :fill="_secondaryfill" :stroke="_secondaryfill"><polyline fill="none" stroke-width="2" points="20,1 20,9 28,9 " stroke-linejoin="miter" stroke-linecap="butt" :stroke="fill"></polyline> <polyline fill="none" stroke-width="2" stroke-linecap="square" points="28,13 28,9 20,1 4,1 4,13 " stroke-linejoin="miter" :stroke="fill"></polyline> <polyline fill="none" stroke-width="2" stroke-linecap="square" points="4,27 4,31 28,31 28,27 " stroke-linejoin="miter" :stroke="fill"></polyline> <path d="M12.7,23h-1.8l-1.1-1.8L8.7,23H6.9l1.9-2.9L7,17.3h1.7l1,1.8l1-1.8h1.8l-1.8,2.9 L12.7,23z" stroke-linejoin="miter" :fill="_secondaryfill"></path> <path d="M15.8,23l-1.2-4.1h0c0.1,0.7,0.1,1.2,0.1,1.6V23h-1.4v-5.7h2.1l1.2,4.1h0l1.2-4.1 h2.1V23h-1.4v-2.5c0-0.1,0-0.3,0-0.4s0-0.5,0.1-1.2h0L17.3,23H15.8z" stroke-linejoin="miter" :fill="_secondaryfill"></path> <path d="M21,23v-5.7h1.5v4.5h2.2V23H21z" stroke-linejoin="miter" :fill="_secondaryfill"></path> <rect x="1" y="13" fill="none" stroke-width="2" stroke-linecap="square" width="30" height="14" stroke-linejoin="miter" :stroke="fill"></rect></g></svg></template>

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