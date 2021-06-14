<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#198B43" d="M48,8c0-1.105-0.896-2-2-2H2C0.896,6,0,6.895,0,8v32c0,1.105,0.896,2,2,2h22V28h24V8z"></path> <path fill="#EA8028" d="M48,28h-8v14h6c1.105,0,2-0.895,2-2V28z"></path> <rect x="32" y="28" fill="#57373A" width="8" height="14"></rect> <rect x="24" y="28" fill="#DD2525" width="8" height="14"></rect> <path fill="#7B6045" d="M44.553,16.894c0.31-0.62,0.277-1.356-0.088-1.946S43.457,14,42.764,14H29.236 c-0.693,0-1.337,0.359-1.701,0.949c-0.364,0.59-0.398,1.326-0.088,1.946L28,18h16L44.553,16.894z"></path> <path fill="#7B6045" d="M38,22l-2,2l-2-2V12c0-1.105,0.895-2,2-2s2,0.895,2,2V22z"></path></g></svg></template>

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