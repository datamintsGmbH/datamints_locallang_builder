<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><polygon points="0,18 36,42 43.211,42 0,13.193 "></polygon> <path fill="#F6DE38" d="M46,6H4.789L48,34.807V8C48,6.895,47.105,6,46,6z"></path> <path fill="#F6DE38" d="M2,42h34L0,18v22C0,41.105,0.895,42,2,42z"></path> <path fill="#E6E6E6" d="M43.211,42H46c1.105,0,2-0.895,2-2v-5.193L4.789,6H2C0.895,6,0,6.895,0,8v5.193L43.211,42z"></path> <path fill="#FF0000" d="M26,29.715V20h6l-2-2h-4v-2l-2-2l-2,2v2h-4l-2,2h6v9.715C18.883,28.9,16.514,26.268,16.102,23 C16.059,23.332,16,23.658,16,24c0,4.418,3.582,8,8,8s8-3.582,8-8c0-0.342-0.059-0.668-0.102-1C31.486,26.268,29.117,28.9,26,29.715z "></path></g></svg></template>

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