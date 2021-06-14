<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#0142A6" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V40z"></path> <path fill="#FFFFFF" d="M26.128,15.225h-1.499L24,13.859l-0.63,1.365h-1.498l1.095,1.132L22.562,18L24,17.184L25.438,18 l-0.405-1.644L26.128,15.225z"></path> <path fill="#FFFFFF" d="M33.155,15.225h-1.499l-0.629-1.365l-0.63,1.365h-1.498l1.095,1.132L29.589,18l1.439-0.816L32.466,18 l-0.405-1.644L33.155,15.225z"></path> <path fill="#FFFFFF" d="M40.256,15.225h-1.499l-0.629-1.365l-0.63,1.365H36l1.095,1.132L36.689,18l1.439-0.816L39.566,18 l-0.405-1.644L40.256,15.225z"></path> <path fill="#FFFFFF" d="M19.101,15.225h-1.499l-0.629-1.365l-0.63,1.365h-1.498l1.095,1.132L15.534,18l1.438-0.816L18.411,18 l-0.405-1.644L19.101,15.225z"></path> <path fill="#FFFFFF" d="M12.256,15.225h-1.499l-0.629-1.365l-0.63,1.365H8l1.095,1.132L8.689,18l1.439-0.816L11.566,18l-0.405-1.644 L12.256,15.225z"></path> <circle fill="#F5CB07" cx="24" cy="28" r="6"></circle></g></svg></template>

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