<template>
  <div class="main">
    <div class="main-content">
      <van-form class="login-form" @submit="onSubmit">
        <div class="form-title"><van-icon size=22 name="friends-o" /><span>Log in</span></div>
        <van-field
          v-model="email"
          name="Email"
          label="Email"
          placeholder="Email"
          :rules="[{ required: true, message: 'Email is required' }]"
        />
        <van-field
          v-model="password"
          type="password"
          name="Password"
          label="Password"
          placeholder="Password"
          :rules="[{ required: true, message: 'Password is required' }]"
        />
        <div class="forgot-password">
          <a href="#">Forgot Password?</a>
        </div>
        <div style="margin: 16px 0;">
          <van-button block type="info" native-type="submit">
            Log in
          </van-button>
        </div>
      </van-form>
      <van-form>
        <div class="signup-hints">New to WAN Card? <a href="/register">Sign up for free</a></div>
      </van-form>
    </div>
  </div>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator'
import * as Vant from 'vant'
import request from '@/api'
import store from '@/store'

Vue.use(Vant)

@Component({
  name: 'Login'
})
export default class Login extends Vue {
  private email: string = ''
  private password: string = ''
  public onSubmit() {
    request.post('/auth/login', {
      email: this.email,
      password: this.password
    })
    .then(response => {
      const data = response.data
      if (data.code === 0) {
        store.dispatch('UserLogin', data.data.access_token)
        Vant.Toast('login successfully')
        location.href = '/home'
      } else {
        Vant.Toast(data.message)
      }
    })
  }
}
</script>

<style lang="less">
a {
  color: #1f85f1;
}
.main {
  background-image: url('../../assets/img/homepage-bgr.png');
  background-size: cover;
  text-align: center;
  height: 100%;
  width: 100%;
  .main-content {
    min-height: 800px;
    max-width: 500px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    margin: auto;
    .login-form {
      padding: 10px 20px;
      background-color: #efefef;
      .form-title {
        height: 80px;
        line-height: 80px;
        font-size: 1.2rem;
        background-color: #efefef;
        color: #676869;
        text-align: left;
        text-indent: 8px;
        font-weight: 500;
        display: flex;
        flex-direction: row;
        align-items: center;
      }
      .van-field {
        margin-bottom: 20px;
      }
      .forgot-password {
        font-size: .8rem;
        margin-right: 5px;
        margin-bottom: 25px;
        text-align: right;
      }
    }
    .signup-hints {
      margin-top: 30px;
      padding: 6px;
      height: 40px;
      line-height: 40px;
      background-color: #efefef;
      color: #676869;
      font-size: .8rem;
    }
  }
}
</style>