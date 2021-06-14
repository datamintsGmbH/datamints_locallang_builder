<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#C0272C" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V40z"></path> <path fill="#484C29" d="M32.361,21.041h-5.891L24,15.683l-2.472,5.358h-5.89l4.304,4.453l-1.591,6.453L24,28.739l5.648,3.208 l-1.591-6.453L32.361,21.041z M26.594,27.912L24,26.438l-2.594,1.474l0.743-3.014l-1.796-1.857h2.454L24,20.458l1.191,2.583h2.455 l-1.796,1.857L26.594,27.912z"></path></g></svg></template>

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