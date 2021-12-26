<template>
  <div>
    <router-view />
  </div>
</template>

<script>
// convert this script into a script that uses create app

export default {
  name: "App",
  el: "app",
};
</script>

<style>
#header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
button {
  display: inline-block;
  outline: 0;
  border: 0;
  cursor: pointer;
  border-radius: 8px;
  padding: 14px 24px 16px;
  font-size: 18px;
  font-weight: 700;
  line-height: 1;
  transition: transform 200ms, background 200ms;
  background: transparent;
  color: #000000;
  box-shadow: 0 0 0 3px #000000 inset;
  margin-right: 10px;
}
button:hover {
  transform: translateY(-2px);
}
.center {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding-bottom: 1rem;
}
</style>
