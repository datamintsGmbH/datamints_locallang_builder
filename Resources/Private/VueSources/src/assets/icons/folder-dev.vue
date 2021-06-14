<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#F9D44C" d="M17,8l-4-4H3C1.895,4,1,4.895,1,6v34c0,2.209,1.791,4,4,4h38c2.209,0,4-1.791,4-4V12c0-2.209-1.791-4-4-4H17 z"></path> <path fill="#C7AA3D" d="M47,14H1V6c0-1.105,0.895-2,2-2h10l4,4h26c2.209,0,4,1.791,4,4V14z"></path> <path fill="#C7AA3D" d="M20,36c-0.256,0-0.512-0.098-0.707-0.293l-6-6c-0.391-0.391-0.391-1.023,0-1.414l6-6 c0.391-0.391,1.023-0.391,1.414,0s0.391,1.023,0,1.414L15.414,29l5.293,5.293c0.391,0.391,0.391,1.023,0,1.414 C20.512,35.902,20.256,36,20,36z"></path> <path fill="#C7AA3D" d="M28,36c-0.256,0-0.512-0.098-0.707-0.293c-0.391-0.391-0.391-1.023,0-1.414L32.586,29l-5.293-5.293 c-0.391-0.391-0.391-1.023,0-1.414s1.023-0.391,1.414,0l6,6c0.391,0.391,0.391,1.023,0,1.414l-6,6C28.512,35.902,28.256,36,28,36z"></path></g></svg></template>

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