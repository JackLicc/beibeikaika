<template>
  <div class="main">
    <div class="steps">
      <van-steps active="0" active-icon="success">
        <van-step>Create Account</van-step>
        <van-step>Account Verification</van-step>
        <van-step>Security Settings</van-step>
      </van-steps>
    </div>
    <div class="promote-text">
      Start with WAN now
    </div>
    <div class="main-content">
      <van-form
        class="register-form"
        @submit="onSubmit"
        label-width="100%"
      >


        <van-field
          v-model="email"
          name="Email"
          label="Email Address"
          placeholder="Please input your email address"
        />

         <van-field
          v-model="verificationCode"
          name="Verification code"
          label="Verification Code"
          placeholder="Please input your Verification code"
        />
        <div class="get-otp-btn">
          <a v-if="count <= 0" href="javascript:void(0)" @click="getOTP">Send Code</a>
          <a v-else href="javascript:void(0)" disabled>{{ this.count }}</a>
        </div>
        <van-field
          v-model="password"
          type="password"
          name="Password"
          label="Password"
          placeholder="Your password should be at least 8 alphanumeric digits"
        />

         <van-field
          v-model="referralCode"
          name="Referral Code"
          label="Referral Code"
          placeholder="Optional, if you have one, please fill in"
        />
        <div class="agree-and-submit">
          <van-checkbox v-model="agreed" shape="square" checked-color="#d68d33">I have read and agreed to Terms & Conditions.</van-checkbox>
          <van-button block round type="primary" native-type="submit">
            Sign up
          </van-button>
          <div class="login-link">
            <a href="/login">Already have an account? Login here</a>
          </div>
        </div>
      </van-form>
    </div>
  </div>
  
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator'
import * as Vant from 'vant'
import request from '@/api'

Vue.use(Vant)

@Component({
  name: 'Register'
})
export default class Register extends Vue {
  private name: string = ''
  private email: string = ''
  private password: string = ''
  private passwordRepeat: string = ''
  private agreed: boolean = true
  private verificationCode: string = ''
  private count: number = 0
  private referralCode: string = ''

  public getOTP() {
    request.post('auth/getRVCode')
      .then(response => {
        const data = response.data
        if (data.code === 0) {
          Vant.Toast("Verification code sent successfully")
          this.count = 60
          let that = this
          const handler = setInterval(function() {
            --that.count
            if (that.count === 0) {
              clearInterval(handler)
            }
          }, 1000)
          return false
        }
      })
      .catch (err => {
        console.log(err)
      })
  }
  public onSubmit() {
    if (this.password != this.passwordRepeat) {
      Vant.Toast("Two passwords don't match")
      return false
    }
    request.post('/auth/register', {
      name: this.name,
      email: this.email,
      referral_code: this.referralCode,
      verification_code: this.verificationCode,
      password: this.password,
      password_confirmation: this.passwordRepeat
    })
    .then(response => {
      const data = response.data
      if (data.code === 0) {
        Vant.Toast('Register successfully')
        location.href = '/login'
      } else {
        Vant.Toast(data.message)
      }
    })
  }
}
</script>

<style lang="less">
@theme-color: #5d823d;
a {
  color: #1f85f1;
}
.main {
  max-width: 1024px;
  margin: auto;
  width: 100%;
  .steps {
    margin-top: 50px;
    .van-step--horizontal .van-step__title {
      font-size: 1.1rem;
    }
  }
  .promote-text {
    color: @theme-color;
    font-size: 1.4rem;
    padding: 40px 0 20px 15px;
    font-weight: 500;
  }
  .main-content {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    .register-form {
      width: 100%;
      height: 100%;
      .get-otp-btn {
        width: 0;
        height: 0;
        float: right;
        position: relative;
        a {
          text-align: center;
          position: absolute;
          left: -155px;
          top: 100px;
          width: 100px;
          color: #3e6bab;
        }
      }
      .agree-and-submit {
        float: left;
        margin: 50px 50px 0 50px;
        .van-checkbox {
          margin-bottom: 30px;
        }
        .login-link {
          text-align:center;
          margin-top:10px;
        }
      }
      .van-cell {
        border-bottom: 1px solid #5fc36b;
      }
      .van-field {
        width: 45%;
        margin-right: 30px;
        float: left;
        margin-top: 40px;
        font-size: 1rem;
        display: flex;
        flex-direction: column;
        .van-field__label {
          width: 148px;
          display: block;
          margin-bottom: 20px;
        }
      }
      .forgot-password {
        font-size: .8rem;
        margin-right: 5px;
        margin-bottom: 25px;
        text-align: right;
      }
    }
    .login-hints {
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