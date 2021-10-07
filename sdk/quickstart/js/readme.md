# How to implement a flag around my feature “Log-in with Google“ and control it through a feature toggle use case in Flagship.

In this scenario, we need have 2 renderings of login page according to visitor timezone. All user in timezone equal or great than 0, will have a basic login process plus a login with Google and user in timezone less than 0 will get only the basic login process. We will change login button color according to timezone too.

|           ![capture 6](./capture6.png)            |
| :-----------------------------------------------: |
| Login for users in timezone equal or great than 0 |

|      ![capture 7](./capture7.png)       |
| :-------------------------------------: |
| Login for users in timezone less than 0 |

## 1. Getting Started

1. Create a toggle use case in [Flagship](https://app.flagship.io/)

![capture 1](./capture1.png)

2. Define flags

![capture 2](./capture2.png)

3. Define scenarios

![capture 3](./capture3.png)

4. Define targeting criteria for each scenario

In this tutoriel, the targeting criteria will be like this:

- Scenario 1: will concern only users who are in timezone equal or greater than 0
- scenario 2: for any other

![capture 4](./capture4.png)

## 2. using Flagship SDK

 <br/>
 
1. Html Structure

```html
<div class="container">
  <div class="align-items-center justify-content-center row vh-100">
    <div class="col-4">
      <form action="">
        <div class="mb-3">
          <h3>Sign in</h3>
          <p class="form-text">
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
          </p>
        </div>
        <div class="input-group mb-3">
          <input
            type="email"
            name=""
            class="form-control"
            placeholder="email"
          />
        </div>
        <div class="input-group mb-3">
          <input
            type="password"
            name=""
            class="form-control"
            placeholder="password"
          />
        </div>
        <button class="btn btn-primary" type="submit">login</button>
        <div class="text-center my-3 d-none" id="login-or">or</div>
        <div class="d-flex justify-content-center d-none" id="google-login">
          <div class="google-btn">
            <div class="google-icon-wrapper">
              <img
                class="google-icon"
                src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg"
                alt="google"
              />
            </div>
            <p class="btn-text"><strong>Sign in with google</strong></p>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
```

1. Import Flagship SDK bundle

```html
<!-- step 1 import flagship Sdk bundle -->
<script src="../flagship/dist/index.browser.js"><script>
```

2. Script

```html
<script>
  //step 2 initialize Flagship SDK
  Flagship.start("envId", "apiKey");

  //step 3 create a flagship visitor

  //when fetch property is unset or true, newVisitor will call synchronizeModifications automatically
  const visitor = Flagship.newVisitor({
    visitorId: "anonymeId",
    context: {
      timezone: new Date().getTimezoneOffset() / -60, //get the user's timezone
    },
    isAuthenticate: false,
  });

  //step 4 listen visitor to be ready
  visitor.on("ready", function (error) {
    if (error) {
      console.log("error", error);
    }

    // step 5 get flag `login-with-google` and `login-btn-color`
    visitor
      .getModification([
        {
          key: "login-with-google",
          defaultValue: false,
        },
        { key: "login-btn-color", defaultValue: "#0d6efd" },
      ])
      .then((flags) => {
        const googleLogin = document.getElementById("google-login");
        const loginOr = document.getElementById("login-or");

        if (!flags[0]) {
          googleLogin.classList.add("d-none");
          loginOr.classList.add("d-none");
        } else {
          googleLogin.classList.remove("d-none");
          loginOr.classList.remove("d-none");
        }

        const loginBtn = document.querySelector("form button");
        loginBtn.style.backgroundColor = flags[1];
      });
  });
</script>
```

The full code can be found on this [link](#)
