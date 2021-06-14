<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#002F68" d="M20,20H0V8c0-1.105,0.895-2,2-2h18V20z"></path> <path fill="#002F68" d="M48,40c0,1.105-0.895,2-2,2H28V28h20V40z"></path> <path fill="#CE1127" d="M0,40c0,1.105,0.895,2,2,2h18V28H0V40z"></path> <path fill="#CE1127" d="M28,20h20V8c0-1.105-0.895-2-2-2H28V20z"></path> <polygon fill="#E6E6E6" points="48,20 28,20 28,6 20,6 20,20 0,20 0,28 20,28 20,42 28,42 28,28 48,28 "></polygon> <path fill="#688671" d="M24,20c-2.209,0-4,1.791-4,4s1.791,4,4,4s4-1.791,4-4S26.209,20,24,20z M24,26c-1.105,0-2-0.895-2-2 c0-1.105,0.895-2,2-2s2,0.895,2,2C26,25.105,25.105,26,24,26z"></path></g></svg></template>

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