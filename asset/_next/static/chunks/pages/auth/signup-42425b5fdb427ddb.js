(self.webpackChunk_N_E = self.webpackChunk_N_E || []).push([
  [5613],
  {
    7942: function (e, n, t) {
      "use strict";
      var r = t(85696);
      n.default = void 0;
      var a,
        s = (a = t(67294)) && a.__esModule ? a : { default: a },
        i = t(64957),
        o = t(69898),
        u = t(90639);
      var c = {};
      function l(e, n, t, r) {
        if (e && i.isLocalURL(n)) {
          e.prefetch(n, t, r).catch(function (e) {
            0;
          });
          var a =
            r && "undefined" !== typeof r.locale ? r.locale : e && e.locale;
          c[n + "%" + t + (a ? "%" + a : "")] = !0;
        }
      }
      var d = function (e) {
        var n,
          t = !1 !== e.prefetch,
          a = o.useRouter(),
          d = s.default.useMemo(
            function () {
              var n = i.resolveHref(a, e.href, !0),
                t = r(n, 2),
                s = t[0],
                o = t[1];
              return { href: s, as: e.as ? i.resolveHref(a, e.as) : o || s };
            },
            [a, e.href, e.as]
          ),
          p = d.href,
          h = d.as,
          f = e.children,
          m = e.replace,
          _ = e.shallow,
          g = e.scroll,
          y = e.locale;
        "string" === typeof f && (f = s.default.createElement("a", null, f));
        var x =
            (n = s.default.Children.only(f)) && "object" === typeof n && n.ref,
          v = u.useIntersection({ rootMargin: "200px" }),
          b = r(v, 2),
          j = b[0],
          w = b[1],
          S = s.default.useCallback(
            function (e) {
              j(e),
                x &&
                  ("function" === typeof x
                    ? x(e)
                    : "object" === typeof x && (x.current = e));
            },
            [x, j]
          );
        s.default.useEffect(
          function () {
            var e = w && t && i.isLocalURL(p),
              n = "undefined" !== typeof y ? y : a && a.locale,
              r = c[p + "%" + h + (n ? "%" + n : "")];
            e && !r && l(a, p, h, { locale: n });
          },
          [h, p, w, y, t, a]
        );
        var O = {
          ref: S,
          onClick: function (e) {
            n.props &&
              "function" === typeof n.props.onClick &&
              n.props.onClick(e),
              e.defaultPrevented ||
                (function (e, n, t, r, a, s, o, u) {
                  ("A" !== e.currentTarget.nodeName ||
                    (!(function (e) {
                      var n = e.currentTarget.target;
                      return (
                        (n && "_self" !== n) ||
                        e.metaKey ||
                        e.ctrlKey ||
                        e.shiftKey ||
                        e.altKey ||
                        (e.nativeEvent && 2 === e.nativeEvent.which)
                      );
                    })(e) &&
                      i.isLocalURL(t))) &&
                    (e.preventDefault(),
                    null == o && r.indexOf("#") >= 0 && (o = !1),
                    n[a ? "replace" : "push"](t, r, {
                      shallow: s,
                      locale: u,
                      scroll: o,
                    }));
                })(e, a, p, h, m, _, g, y);
          },
          onMouseEnter: function (e) {
            n.props &&
              "function" === typeof n.props.onMouseEnter &&
              n.props.onMouseEnter(e),
              i.isLocalURL(p) && l(a, p, h, { priority: !0 });
          },
        };
        if (e.passHref || ("a" === n.type && !("href" in n.props))) {
          var C = "undefined" !== typeof y ? y : a && a.locale,
            I =
              a &&
              a.isLocaleDomain &&
              i.getDomainLocale(h, C, a && a.locales, a && a.domainLocales);
          O.href = I || i.addBasePath(i.addLocale(h, C, a && a.defaultLocale));
        }
        return s.default.cloneElement(n, O);
      };
      n.default = d;
    },
    90639: function (e, n, t) {
      "use strict";
      var r = t(85696);
      Object.defineProperty(n, "__esModule", { value: !0 }),
        (n.useIntersection = function (e) {
          var n = e.rootRef,
            t = e.rootMargin,
            u = e.disabled || !i,
            c = a.useRef(),
            l = a.useState(!1),
            d = r(l, 2),
            p = d[0],
            h = d[1],
            f = a.useState(n ? n.current : null),
            m = r(f, 2),
            _ = m[0],
            g = m[1],
            y = a.useCallback(
              function (e) {
                c.current && (c.current(), (c.current = void 0)),
                  u ||
                    p ||
                    (e &&
                      e.tagName &&
                      (c.current = (function (e, n, t) {
                        var r = (function (e) {
                            var n = e.rootMargin || "",
                              t = o.get(n);
                            if (t) return t;
                            var r = new Map(),
                              a = new IntersectionObserver(function (e) {
                                e.forEach(function (e) {
                                  var n = r.get(e.target),
                                    t =
                                      e.isIntersecting ||
                                      e.intersectionRatio > 0;
                                  n && t && n(t);
                                });
                              }, e);
                            return (
                              o.set(
                                n,
                                (t = { id: n, observer: a, elements: r })
                              ),
                              t
                            );
                          })(t),
                          a = r.id,
                          s = r.observer,
                          i = r.elements;
                        return (
                          i.set(e, n),
                          s.observe(e),
                          function () {
                            i.delete(e),
                              s.unobserve(e),
                              0 === i.size && (s.disconnect(), o.delete(a));
                          }
                        );
                      })(
                        e,
                        function (e) {
                          return e && h(e);
                        },
                        { root: _, rootMargin: t }
                      )));
              },
              [u, _, t, p]
            );
          return (
            a.useEffect(
              function () {
                if (!i && !p) {
                  var e = s.requestIdleCallback(function () {
                    return h(!0);
                  });
                  return function () {
                    return s.cancelIdleCallback(e);
                  };
                }
              },
              [p]
            ),
            a.useEffect(
              function () {
                n && g(n.current);
              },
              [n]
            ),
            [y, p]
          );
        });
      var a = t(67294),
        s = t(26286),
        i = "undefined" !== typeof IntersectionObserver;
      var o = new Map();
    },
    86989: function (e, n, t) {
      "use strict";
      t.r(n),
        t.d(n, {
          default: function () {
            return k;
          },
        });
      var r = t(50029),
        a = t(59499),
        s = t(87794),
        i = t.n(s),
        o = t(67294),
        u = t(9008),
        c = t(70449),
        l = t(11163),
        d = t(48287),
        p = t(56348),
        h = t(57248),
        f = t(17124),
        m = t(23182),
        _ = t(41664),
        g = t(35005),
        y = t.n(g),
        x = t(54081),
        v = t(68124),
        b = t(67750),
        j = t(85893);
      function w(e, n) {
        var t = Object.keys(e);
        if (Object.getOwnPropertySymbols) {
          var r = Object.getOwnPropertySymbols(e);
          n &&
            (r = r.filter(function (n) {
              return Object.getOwnPropertyDescriptor(e, n).enumerable;
            })),
            t.push.apply(t, r);
        }
        return t;
      }
      function S(e) {
        for (var n = 1; n < arguments.length; n++) {
          var t = null != arguments[n] ? arguments[n] : {};
          n % 2
            ? w(Object(t), !0).forEach(function (n) {
                (0, a.Z)(e, n, t[n]);
              })
            : Object.getOwnPropertyDescriptors
            ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t))
            : w(Object(t)).forEach(function (n) {
                Object.defineProperty(
                  e,
                  n,
                  Object.getOwnPropertyDescriptor(t, n)
                );
              });
        }
        return e;
      }
      var O = function (e) {
          var n = e.nextStep,
            t = e.currentStep,
            r = e.setUserType,
            a = e.userType;
          if (1 !== t) return null;
          return (0, j.jsxs)(j.Fragment, {
            children: [
              (0, j.jsxs)(d.BZ, {
                children: [
                  (0, j.jsx)(d.__, { children: "User Type" }),
                  (0, j.jsxs)("label", {
                    className: y().radio,
                    children: [
                      (0, j.jsx)("input", {
                        name: "userType",
                        onChange: function (e) {
                          return r(e.target.value);
                        },
                        type: "radio",
                        value: f.xe.cooprate,
                      }),
                      (0, j.jsxs)("div", {
                        children: [
                          (0, j.jsx)("span", { children: "Corporate" }),
                          (0, j.jsx)("p", {
                            children:
                              "Choose this if you have a registered business with an RC Number, BN Number, CAC Number, etc.",
                          }),
                        ],
                      }),
                    ],
                  }),
                  (0, j.jsxs)("label", {
                    className: y().radio,
                    children: [
                      (0, j.jsx)("input", {
                        name: "userType",
                        onChange: function (e) {
                          return r(e.target.value);
                        },
                        type: "radio",
                        value: f.xe.domestic,
                      }),
                      (0, j.jsxs)("div", {
                        children: [
                          (0, j.jsx)("span", { children: "Individual" }),
                          (0, j.jsx)("p", {
                            children:
                              "Choose this if you are an individual or if you do not have a registered business.",
                          }),
                        ],
                      }),
                    ],
                  }),
                ],
              }),
              (0, j.jsx)(p.Z, {
                className: y().button,
                htmlType: "submit",
                onClick: function (e) {
                  return (function (e) {
                    f.xe.domestic === a ? n(e, 2) : n(e);
                  })(e);
                },
                type: p.q.primary,
                children: "Continue",
              }),
            ],
          });
        },
        C = function (e) {
          var n = e.inputs,
            t = e.prevStep,
            r = e.nextStep,
            a = e.handleInputChange,
            s = e.currentStep,
            i = e.industries,
            u = e.userType,
            c = (0, o.useState)(""),
            l = c[0],
            h = c[1],
            m = (0, o.useState)(""),
            _ = m[0],
            g = m[1];
          if (2 !== s) return null;
          return (0, j.jsx)(j.Fragment, {
            children:
              u === f.xe.cooprate &&
              (0, j.jsxs)(j.Fragment, {
                children: [
                  (0, j.jsx)("span", { children: "Step 2/4" }),
                  (0, j.jsx)("h3", { children: "Company Details" }),
                  (0, j.jsxs)(d.BZ, {
                    children: [
                      (0, j.jsx)(d.__, { children: "Company Name" }),
                      (0, j.jsx)(d.II, {
                        handleInputChange: a,
                        min: "0",
                        name: "companyName",
                        required: !0,
                        type: "text",
                        validation: d.HI.alphanumeric,
                        value: n.companyName,
                      }),
                    ],
                  }),
                  (0, j.jsxs)(d.BZ, {
                    children: [
                      (0, j.jsx)(d.__, { children: "CAC Registration Number" }),
                      (0, j.jsx)(d.II, {
                        handleInputChange: a,
                        min: "0",
                        name: "cac",
                        required: !0,
                        type: "number",
                        validation: d.HI.alphanumeric,
                        value: n.cac,
                      }),
                    ],
                  }),
                  (0, j.jsxs)(d.BZ, {
                    children: [
                      (0, j.jsx)(d.__, { children: "Company Address" }),
                      (0, j.jsx)(d.II, {
                        handleInputChange: a,
                        min: "0",
                        name: "companyAddress",
                        required: !0,
                        type: "text",
                        validation: d.HI.alphanumeric,
                        value: n.companyAddress,
                      }),
                    ],
                  }),
                  (0, j.jsxs)(d.BZ, {
                    children: [
                      (0, j.jsx)(d.__, { children: "Industry" }),
                      (0, j.jsxs)(d.Ph, {
                        name: "industryId",
                        onChange: function (e) {
                          return (function (e) {
                            a(e), g(e.target.value), (n.industryId = _);
                          })(e);
                        },
                        children: [
                          (0, j.jsx)("option", { children: "Choose one" }),
                          Array.isArray(i) &&
                            i.map(function (e) {
                              return (0,
                              j.jsx)("option", { value: e.id, children: e.name }, e.id);
                            }),
                        ],
                      }),
                    ],
                  }),
                  (0, j.jsx)(d._o, { errors: l }),
                  (0, j.jsxs)("div", {
                    className: y().date,
                    children: [
                      (0, j.jsx)(p.Z, {
                        className: (0, x.Tz)(
                          y().button,
                          y().dateChild,
                          y().dateStart
                        ),
                        htmlType: "button",
                        onClick: function (e) {
                          return t(e);
                        },
                        type: p.q.outline,
                        children: "Back",
                      }),
                      (0, j.jsx)(p.Z, {
                        className: (0, x.Tz)(y().button, y().dateChild),
                        htmlType: "button",
                        onClick: function (e) {
                          return (function (e) {
                            var t = n.companyName,
                              a = n.cac,
                              s = n.companyAddress,
                              i = n.industryId;
                            (0, v.xb)(t)
                              ? h("Company name cannot be empty")
                              : (0, v.xb)(a)
                              ? h("Please provide your company CAC's number")
                              : (0, v.xb)(s)
                              ? h("Please input your company's address")
                              : (0, v.xb)(i)
                              ? h("Please select your industry type")
                              : (h(""), r(e));
                          })(e);
                        },
                        type: p.q.primary,
                        children: "Continue",
                      }),
                    ],
                  }),
                ],
              }),
          });
        },
        I = function (e) {
          var n = e.prevStep,
            t = e.nextStep,
            r = e.currentStep,
            a = e.userType,
            s = e.handleInputChange,
            i = e.inputs,
            u = (e.states, (0, o.useState)("")),
            c = u[0],
            l = u[1],
            h = (0, o.useState)(""),
            m = h[0],
            _ = h[1],
            g = (0, o.useState)(""),
            b = g[0],
            w = g[1],
            S = (0, o.useState)(i.agentLga || ""),
            O = (S[0], S[1], (0, o.useState)(i.state || "")),
            C = (O[0], O[1], (0, o.useState)("")),
            I = C[0],
            P = C[1];
          if (3 !== r) return null;
          return (0, j.jsxs)(j.Fragment, {
            children: [
              (a === f.xe.cooprate &&
                (0, j.jsx)("span", { children: "Step 3/4" })) ||
                (0, j.jsx)("span", { children: "Step 2/3" }),
              (0, j.jsx)("h3", { children: "Personal Details" }),
              (0, j.jsxs)(d.BZ, {
                children: [
                  (0, j.jsx)(d.__, { children: "First Name" }),
                  (0, j.jsx)(d.II, {
                    handleInputChange: s,
                    name: "firstname",
                    required: !0,
                    type: "text",
                    validation: d.HI.text,
                    value: i.firstname,
                  }),
                ],
              }),
              (0, j.jsxs)(d.BZ, {
                children: [
                  (0, j.jsx)(d.__, { children: "Last Name" }),
                  (0, j.jsx)(d.II, {
                    handleInputChange: s,
                    name: "lastname",
                    required: !0,
                    type: "text",
                    validation: d.HI.text,
                    value: i.lastname,
                  }),
                ],
              }),
              (0, j.jsxs)(d.BZ, {
                children: [
                  (0, j.jsx)(d.__, { children: "Phone" }),
                  (0, j.jsx)(d.II, {
                    handleInputChange: s,
                    name: "phone",
                    required: !0,
                    type: "tel",
                    validation: d.HI.tel,
                    value: i.phone,
                  }),
                ],
              }),
              a === f.xe.cooprate &&
                (0, j.jsxs)(d.BZ, {
                  children: [
                    (0, j.jsx)(d.__, { children: "Job Title" }),
                    (0, j.jsxs)(d.Ph, {
                      name: "jobTitle",
                      onChange: function (e) {
                        return (function (e) {
                          s(e),
                            "jobTitle" == e.target.name
                              ? (l(e.target.value), (i.jobTitle = c))
                              : "hasSmartphone" == e.target.name
                              ? (_(e.target.value), (i.hasSmartphone = m))
                              : "hasBike" == e.target.name &&
                                (w(e.target.value), (i.hasBike = b));
                        })(e);
                      },
                      value: c,
                      children: [
                        (0, j.jsx)("option", { children: "Choose one" }),
                        f.gO.map(function (e) {
                          return (0,
                          j.jsx)("option", { value: e.position, children: e.position }, e.id);
                        }),
                      ],
                    }),
                  ],
                }),
              (0, j.jsx)(d._o, { errors: I }),
              (0, j.jsxs)("div", {
                className: y().date,
                children: [
                  (0, j.jsx)(p.Z, {
                    className: (0, x.Tz)(
                      y().button,
                      y().dateChild,
                      y().dateStart
                    ),
                    htmlType: "button",
                    onClick: function (e) {
                      return (function (e) {
                        f.xe.domestic === a ? n(e, 2) : n(e);
                      })(e);
                    },
                    type: p.q.outline,
                    children: "Back",
                  }),
                  (0, j.jsx)(p.Z, {
                    className: (0, x.Tz)(y().button, y().dateChild),
                    htmlType: "button",
                    onClick: function (e) {
                      return (function (e) {
                        var n = i.firstname,
                          r = i.lastname,
                          s = i.phone,
                          o = i.jobTitle;
                        i.hasBike,
                          i.hasSmartphone,
                          (0, v.xb)(n)
                            ? P("First name is required")
                            : (0, v.xb)(r)
                            ? P("Last name is required")
                            : (0, v.xb)(s)
                            ? P("Phone number is required")
                            : (0, v.xb)(o) && a === f.xe.cooprate
                            ? P("JobTitle is required")
                            : (P(""), t(e));
                      })(e);
                    },
                    type: p.q.primary,
                    children: "Continue",
                  }),
                ],
              }),
            ],
          });
        },
        P = function (e) {
          var n = e.validations,
            t = { textDecoration: "line-through", color: "rgb(194, 194, 194)" };
          return (0, j.jsxs)("div", {
            className: y().passwordMeter,
            children: [
              (0, j.jsx)("div", {
                className: y().item,
                style: n && n.ALOupper ? t : {},
                children: "must have at least one uppercase",
              }),
              (0, j.jsx)("div", {
                className: y().item,
                style: n && n.ALOnumeric ? t : {},
                children: "must have at least one numeral",
              }),
              (0, j.jsx)("div", {
                className: y().item,
                style: n && n.ALOcount ? t : {},
                children: "must have more than 8 charachters",
              }),
              (0, j.jsx)("div", {
                className: y().item,
                style: n && n.ALOsymbol ? t : {},
                children: "must contain a special character eg @,#,$ etc",
              }),
            ],
          });
        },
        N = function (e) {
          var n = e.currentStep,
            t = e.userType,
            r = e.inputs,
            a = e.handleInputChange,
            s = e.validations,
            i = e.showPM;
          if (4 !== n) return null;
          return (0, j.jsxs)(j.Fragment, {
            children: [
              (t === f.xe.cooprate &&
                (0, j.jsx)("span", { children: "Step 4/4" })) ||
                (0, j.jsx)("span", { children: "Step 3/3" }),
              (0, j.jsx)("h3", { children: "Login Details" }),
              (0, j.jsxs)(d.BZ, {
                children: [
                  (0, j.jsx)(d.__, { children: "Email Address" }),
                  (0, j.jsx)(d.II, {
                    handleInputChange: a,
                    name: "email",
                    placeholder: "john@examplemail.com",
                    required: !0,
                    type: "email",
                    validation: d.HI.email,
                    value: r.email,
                  }),
                ],
              }),
              (0, j.jsxs)(d.BZ, {
                children: [
                  (0, j.jsx)(d.__, { children: "Create a Password" }),
                  (0, j.jsx)(d.II, {
                    name: "password",
                    onChange: function (e) {
                      return a(e);
                    },
                    placeholder: "Enter your password",
                    required: !0,
                    autoComplete: "off",
                    type: "password",
                    value: r.password,
                  }),
                ],
              }),
              i && (0, j.jsx)(P, { validations: s && s }),
              (0, j.jsxs)(d.BZ, {
                children: [
                  (0, j.jsx)(d.__, { children: "Confirm Password" }),
                  (0, j.jsx)(d.II, {
                    name: "confirmPassword",
                    onChange: function (e) {
                      return a(e);
                    },
                    required: !0,
                    autoComplete: "off",
                    type: "password",
                    value: r.confirmPassword,
                  }),
                ],
              }),
              t === f.xe.cooprate &&
                (0, j.jsx)(d.BZ, {
                  children: (0, j.jsxs)(d.I0, {
                    onChange: function (e) {
                      return (function (e) {
                        "slaAgreement" == e.target.name &&
                          (r.slaAgreement = e.target.checked);
                      })(e);
                    },
                    name: "slaAgreement",
                    value: r.slaAgreement,
                    children: [
                      "By submitting this form, you have agreed to our ",
                      (0, j.jsx)("a", {
                        href: "/sla",
                        target: "_blank",
                        children: "Service Agreement Level",
                      }),
                    ],
                  }),
                }),
            ],
          });
        },
        Z = function (e) {
          var n = e.industries,
            t = e.states,
            r = e.defaultType,
            s = 1;
          r &&
            Object.values(f.xe).includes(r) &&
            (s = r === f.xe.cooprate ? 2 : 3);
          var i = (0, c.OW)(h.z2),
            g = i.error,
            v = i.submit,
            w = i.submitting,
            P = (0, o.useState)(s),
            Z = P[0],
            k = P[1],
            T = (0, o.useState)(r),
            q = T[0],
            B = T[1],
            A = (0, o.useState)({}),
            L = A[0],
            E = A[1],
            D = (0, o.useState)({
              ALOcount: !1,
              ALOnumeric: !1,
              ALOsymbol: !1,
              ALOupper: !1,
            }),
            R = D[0],
            M = D[1],
            $ = (0, o.useState)(!1),
            z = $[0],
            F = $[1],
            H = (0, b.t)(),
            U = function (e) {
              var n =
                arguments.length > 1 && void 0 !== arguments[1]
                  ? arguments[1]
                  : 1;
              e.preventDefault(), Z < 4 && k(Z + n);
            },
            W = function (e) {
              var n =
                arguments.length > 1 && void 0 !== arguments[1]
                  ? arguments[1]
                  : 1;
              e.preventDefault(), Z > 1 && k(Z - n);
            },
            K = function (e) {
              if ((e.persist(), "password" == e.target.name)) {
                var n = (function (e) {
                  var n = new RegExp("(?=.*[0-9])"),
                    t = new RegExp("(?=.*[A-Z])"),
                    r = new RegExp("(?=.{8,})"),
                    a = new RegExp("(?=.[!@#$%^&])"),
                    s = {};
                  return (
                    (s.ALOnumeric = n.test(e)),
                    (s.ALOupper = t.test(e)),
                    (s.ALOcount = r.test(e)),
                    (s.ALOsymbol = a.test(e)),
                    s
                  );
                })(e.target.value);
                z || F(!0),
                  M(n),
                  E(function (n) {
                    return S(
                      S({}, n),
                      {},
                      (0, a.Z)({}, e.target.name, e.target.value)
                    );
                  }),
                  Object.values(n).reduce(function (e, n) {
                    return e && n;
                  }) && F(!1);
              } else
                E(function (n) {
                  return S(
                    S({}, n),
                    {},
                    (0, a.Z)({}, e.target.name, e.target.value)
                  );
                });
            };
          return (
            (0, o.useEffect)(function () {
              localStorage.removeItem(m.Z.storageKeys.auth);
            }, []),
            (0, j.jsxs)(j.Fragment, {
              children: [
                (0, j.jsx)(u.default, {
                  children: (0, j.jsx)("title", {
                    children: "Signup | VerifyMe",
                  }),
                }),
                (0, j.jsxs)("div", {
                  className: y().container,
                  children: [
                    (0, j.jsxs)("aside", {
                      className: y().aside,
                      children: [
                        (0, j.jsx)("h2", {
                          className: y().asideTitle,
                          children: "Already have an account?",
                        }),
                        (0, j.jsx)("p", {
                          className: y().asideSubtitle,
                          children:
                            "Welcome back! Sign in to VerifyMe with your credentials",
                        }),
                        (0, j.jsx)(p.Z, {
                          className: y().asideButton,
                          href: "/auth/login" + H,
                          type: p.q.outline,
                          children: "Sign In",
                        }),
                      ],
                    }),
                    (0, j.jsxs)("div", {
                      className: y().content,
                      children: [
                        (0, j.jsx)("h2", {
                          className: y().contentTitle,
                          children: "Sign up to get started",
                        }),
                        (0, j.jsx)("p", {
                          className: y().contentSubtitle,
                          children:
                            "Start getting to know your customers better",
                        }),
                        (0, j.jsxs)("form", {
                          onSubmit: function (e) {
                            return v(
                              e,
                              function () {
                                q === f.xe.cooprate
                                  ? l.default.push(
                                      "/auth/corporate-confirm-email"
                                    )
                                  : l.default.push("/auth/confirm-email");
                              },
                              void 0,
                              S(S({}, L), {}, { userType: q })
                            );
                          },
                          children: [
                            (0, j.jsx)(O, {
                              currentStep: Z,
                              handleInputChange: K,
                              inputs: L,
                              nextStep: U,
                              setUserType: B,
                              userType: q,
                            }),
                            (0, j.jsx)(C, {
                              currentStep: Z,
                              handleInputChange: K,
                              industries: n,
                              inputs: L,
                              nextStep: U,
                              prevStep: W,
                              userType: q,
                            }),
                            (0, j.jsx)(I, {
                              currentStep: Z,
                              handleInputChange: K,
                              inputs: L,
                              nextStep: U,
                              prevStep: W,
                              userType: q,
                              states: t,
                            }),
                            (0, j.jsx)(N, {
                              currentStep: Z,
                              handleInputChange: K,
                              inputs: L,
                              userType: q,
                              validations: R,
                              showPM: z,
                            }),
                            (0, j.jsx)(d._o, { errors: g }),
                            4 === Z &&
                              (0, j.jsxs)("div", {
                                className: y().date,
                                children: [
                                  (0, j.jsx)(p.Z, {
                                    className: (0, x.Tz)(
                                      y().button,
                                      y().dateChild,
                                      y().dateStart
                                    ),
                                    htmlType: "submit",
                                    onClick: function (e) {
                                      return W(e, 1);
                                    },
                                    type: p.q.outline,
                                    children: "Back",
                                  }),
                                  (0, j.jsx)(p.Z, {
                                    className: (0, x.Tz)(
                                      y().button,
                                      y().dateChild
                                    ),
                                    htmlType: "submit",
                                    loading: w,
                                    type: p.q.primary,
                                    children: "Signup",
                                  }),
                                ],
                              }),
                          ],
                        }),
                        (0, j.jsxs)("div", {
                          className: "show-on-small",
                          children: [
                            (0, j.jsx)("br", {}),
                            (0, j.jsxs)("p", {
                              className: "align-center",
                              children: [
                                "Already have an account? ",
                                (0, j.jsx)(_.default, {
                                  href: "/auth/login",
                                  children: (0, j.jsx)("a", {
                                    rel: "noopener noreferrer",
                                    className: "strong no-decor",
                                    children: "Sign In",
                                  }),
                                }),
                                " now!",
                              ],
                            }),
                          ],
                        }),
                      ],
                    }),
                  ],
                }),
              ],
            })
          );
        };
      Z.getInitialProps = (function () {
        var e = (0, r.Z)(
          i().mark(function e(n) {
            var t, r, a, s, o, u;
            return i().wrap(function (e) {
              for (;;)
                switch ((e.prev = e.next)) {
                  case 0:
                    return (
                      (t = n.query),
                      (r = ""),
                      t && t.type && (r = String(t.type).trim()),
                      "\n      query{\n        industries {\n          id,\n          name\n        }\n        states(countryId: 1){\n            id\n            name\n        }\n      }\n    ",
                      (a = (0, c.ZP)()),
                      (e.next = 7),
                      a
                        .request(
                          "\n      query{\n        industries {\n          id,\n          name\n        }\n        states(countryId: 1){\n            id\n            name\n        }\n      }\n    "
                        )
                        .then(function (e) {
                          return e;
                        })
                        .catch(function (e) {
                          return e.message;
                        })
                    );
                  case 7:
                    return (
                      (s = e.sent),
                      (o = s.industries),
                      (u = s.states),
                      e.abrupt("return", {
                        defaultType: r,
                        industries: o,
                        states: u,
                        layout: {
                          hideFooter: !0,
                          hideNav: !0,
                          showBottomBackground: !1,
                        },
                      })
                    );
                  case 11:
                  case "end":
                    return e.stop();
                }
            }, e);
          })
        );
        return function (n) {
          return e.apply(this, arguments);
        };
      })();
      var k = Z;
    },
    56348: function (e, n, t) {
      "use strict";
      t.d(n, {
        q: function () {
          return r;
        },
      });
      var r,
        a = t(59499),
        s = t(4730),
        i = (t(67294), t(11163)),
        o = t(62267),
        u = t(54081),
        c = t(37437),
        l = t.n(c),
        d = t(85893),
        p = [
          "children",
          "className",
          "fullWidth",
          "href",
          "htmlType",
          "loading",
          "onClick",
          "type",
        ];
      function h(e, n) {
        var t = Object.keys(e);
        if (Object.getOwnPropertySymbols) {
          var r = Object.getOwnPropertySymbols(e);
          n &&
            (r = r.filter(function (n) {
              return Object.getOwnPropertyDescriptor(e, n).enumerable;
            })),
            t.push.apply(t, r);
        }
        return t;
      }
      function f(e) {
        for (var n = 1; n < arguments.length; n++) {
          var t = null != arguments[n] ? arguments[n] : {};
          n % 2
            ? h(Object(t), !0).forEach(function (n) {
                (0, a.Z)(e, n, t[n]);
              })
            : Object.getOwnPropertyDescriptors
            ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t))
            : h(Object(t)).forEach(function (n) {
                Object.defineProperty(
                  e,
                  n,
                  Object.getOwnPropertyDescriptor(t, n)
                );
              });
        }
        return e;
      }
      !(function (e) {
        (e.basic = "basic"),
          (e.outline = "outline"),
          (e.primary = "primary"),
          (e.custom = "custom");
      })(r || (r = {}));
      n.Z = function (e) {
        var n = e.children,
          t = e.className,
          a = e.fullWidth,
          c = e.href,
          h = e.htmlType,
          m = e.loading,
          _ = e.onClick,
          g = e.type,
          y = (0, s.Z)(e, p),
          x = c ? "a" : "button",
          v = f(
            {
              className: (0, u.Tz)(
                t,
                l().button,
                l()[g || r.outline],
                a && l().fullWidth,
                m && l().loading
              ),
              onClick:
                _ ||
                function (e) {
                  c && (e.preventDefault(), i.default.push(c));
                },
              type: h,
            },
            y
          );
        return (0, d.jsx)(
          x,
          f(
            f({}, v),
            {},
            {
              children: m
                ? (0, d.jsx)(o.r, {
                    style: { maxHeight: "15px", stroke: "currentColor" },
                  })
                : n,
            }
          )
        );
      };
    },
    67750: function (e, n, t) {
      "use strict";
      t.d(n, {
        t: function () {
          return a;
        },
        W: function () {
          return s;
        },
      });
      var r = t(11163);
      function a() {
        var e = (0, r.useRouter)(),
          n = "",
          t = 0;
        for (var a in e.query)
          (n = (n = 0 === t ? n + "?" : n + "&") + (a + "=") + e.query[a]), t++;
        return n;
      }
      function s() {
        return !0;
      }
    },
    57248: function (e, n, t) {
      "use strict";
      t.d(n, {
        x4: function () {
          return m;
        },
        Lv: function () {
          return _;
        },
        z2: function () {
          return g;
        },
        gF: function () {
          return y;
        },
        Lo: function () {
          return x;
        },
      });
      var r = t(59499),
        a = t(50029),
        s = t(87794),
        i = t.n(s),
        o = t(74231),
        u = t(76427),
        c = t.n(u),
        l = t(70449),
        d = t(17124);
      function p(e, n) {
        var t = Object.keys(e);
        if (Object.getOwnPropertySymbols) {
          var r = Object.getOwnPropertySymbols(e);
          n &&
            (r = r.filter(function (n) {
              return Object.getOwnPropertyDescriptor(e, n).enumerable;
            })),
            t.push.apply(t, r);
        }
        return t;
      }
      function h(e) {
        for (var n = 1; n < arguments.length; n++) {
          var t = null != arguments[n] ? arguments[n] : {};
          n % 2
            ? p(Object(t), !0).forEach(function (n) {
                (0, r.Z)(e, n, t[n]);
              })
            : Object.getOwnPropertyDescriptors
            ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t))
            : p(Object(t)).forEach(function (n) {
                Object.defineProperty(
                  e,
                  n,
                  Object.getOwnPropertyDescriptor(t, n)
                );
              });
        }
        return e;
      }
      var f =
          "\n    id\n    email\n    phone\n    firstname\n    lastname\n    username\n    token\n    userGroup {\n        group{\n            id\n            name\n            organisation {\n                id\n                name\n                industryId\n                cac\n                allowInvoice\n                allowKyc\n                status\n                slaPrice\n                address\n                allowAddressPlatform\n            }\n        }\n        role{\n            id\n            code\n            name\n        }\n        status{\n            id\n            code\n            label\n        }\n    }\n    userGroups {\n        group {\n            id\n            name\n            organisation {\n                id\n                name\n                industryId\n                cac\n                allowInvoice\n                allowKyc\n                status\n                slaPrice\n                address\n                allowAddressPlatform\n            }\n        }\n        role {\n            id\n            code\n            name\n        }\n        status {\n            id\n            code\n            label\n        }\n    }\n",
        m = (function () {
          var e = (0, a.Z)(
            i().mark(function e(n) {
              var t, r, a, s, u;
              return i().wrap(function (e) {
                for (;;)
                  switch ((e.prev = e.next)) {
                    case 0:
                      return (
                        (t = o
                          .Ry()
                          .shape({
                            password: o.Z_().required(),
                            username: o.Z_().required(),
                          })),
                        (e.next = 3),
                        t
                          .validate(n)
                          .then(function () {
                            return "";
                          })
                          .catch(function (e) {
                            return e.message;
                          })
                      );
                    case 3:
                      if (!(r = e.sent)) {
                        e.next = 6;
                        break;
                      }
                      return e.abrupt("return", { error: r });
                    case 6:
                      return (
                        (a =
                          "\n    mutation loginUser($password: String!, $username: String!) {\n      authenticate(password: $password, username: $username) {\n        ".concat(
                            f,
                            "\n      }\n    }\n    "
                          )),
                        (s = (0, l.ZP)()),
                        (e.next = 10),
                        s
                          .request(a, n)
                          .then(function (e) {
                            return { response: e };
                          })
                          .catch(function (e) {
                            return { error: e.response && e.response.errors };
                          })
                      );
                    case 10:
                      return (u = e.sent), e.abrupt("return", u);
                    case 12:
                    case "end":
                      return e.stop();
                  }
              }, e);
            })
          );
          return function (n) {
            return e.apply(this, arguments);
          };
        })(),
        _ = (function () {
          var e = (0, a.Z)(
            i().mark(function e(n) {
              var t, r, a;
              return i().wrap(function (e) {
                for (;;)
                  switch ((e.prev = e.next)) {
                    case 0:
                      return (
                        (t =
                          "\n    mutation switchSessionOrganisation($id: Float!) {\n        switchSessionOrganisation(id: $id) {\n        ".concat(
                            f,
                            "\n      }\n    }\n    "
                          )),
                        (r = (0, l.ZP)()),
                        (e.next = 4),
                        r
                          .request(t, n)
                          .then(function (e) {
                            return { response: e };
                          })
                          .catch(function (e) {
                            return { error: e.response && e.response.errors };
                          })
                      );
                    case 4:
                      return (a = e.sent), e.abrupt("return", a);
                    case 6:
                    case "end":
                      return e.stop();
                  }
              }, e);
            })
          );
          return function (n) {
            return e.apply(this, arguments);
          };
        })(),
        g = (function () {
          var e = (0, a.Z)(
            i().mark(function e(n) {
              var t, r, a, s, u, p, m;
              return i().wrap(function (e) {
                for (;;)
                  switch ((e.prev = e.next)) {
                    case 0:
                      return (
                        (t = {
                          email: o.Z_().email().required(),
                          firstname: o
                            .Z_()
                            .matches(/^[a-zA-Z-]+$/, {
                              excludeEmptyString: !0,
                              message:
                                "First Name can't contain numbers and some special characters",
                            })
                            .required(),
                          lastname: o
                            .Z_()
                            .matches(/^[a-zA-Z-]+$/, {
                              excludeEmptyString: !0,
                              message:
                                "Last Name can't contain numbers and some special characters",
                            })
                            .required(),
                          phone: o.Z_().required(),
                        }),
                        n.userType === d.xe.cooprate &&
                          ((r =
                            "Please accept our service level agreement to proceed"),
                          (t = h(
                            h({}, t),
                            {},
                            {
                              industryId: o.Z_().required(),
                              cac: o.Z_().required(),
                              companyName: o.Z_().required(),
                              companyAddress: o.Z_().required(),
                              jobTitle: o.Z_().required(),
                              slaAgreement: o.O7().oneOf([!0], r).required(r),
                            }
                          ))),
                        n.organisationId ||
                          (t = h(
                            h({}, t),
                            {},
                            {
                              password: o
                                .Z_()
                                .matches(
                                  /(?=.*\d)(?=.*[a-z]).{6,}/,
                                  "Password must contain alphanumeric character and minimum of 6 characters"
                                )
                                .required(),
                              confirmPassword: o.Z_().required(),
                            }
                          )),
                        (a = o.Ry().shape(t)),
                        n.userType === d.xe.agent &&
                          ((n.isAgent = !0),
                          (n.hasBike = Boolean(Number(n.hasBike))),
                          (n.hasSmartphone = Boolean(Number(n.hasSmartphone))),
                          delete n.state),
                        (e.next = 7),
                        a
                          .validate(n)
                          .then(function () {
                            return "";
                          })
                          .catch(function (e) {
                            return e.message;
                          })
                      );
                    case 7:
                      if (!(s = e.sent)) {
                        e.next = 10;
                        break;
                      }
                      return e.abrupt("return", { error: s });
                    case 10:
                      if (n.confirmPassword === n.password) {
                        e.next = 12;
                        break;
                      }
                      return e.abrupt("return", {
                        error: "Passwords do not match",
                      });
                    case 12:
                      return (
                        (u =
                          "\n  mutation registerUser($data: UserInput!) {\n    register(data: $data){\n      ".concat(
                            f,
                            "\n    }\n  }\n  "
                          )),
                        (p = (0, l.ZP)()),
                        (e.next = 16),
                        p
                          .request(u, {
                            data: c()(
                              h(
                                h({}, n),
                                {},
                                {
                                  organisationId: parseFloat(n.organisationId),
                                  groupId: parseFloat(n.groupId),
                                  roleId: parseFloat(n.roleId),
                                }
                              ),
                              ["confirmPassword", "slaAgreement"]
                            ),
                          })
                          .then(function (e) {
                            return { response: e };
                          })
                          .catch(function (e) {
                            return { error: e.response && e.response.errors };
                          })
                      );
                    case 16:
                      return (m = e.sent), e.abrupt("return", m);
                    case 18:
                    case "end":
                      return e.stop();
                  }
              }, e);
            })
          );
          return function (n) {
            return e.apply(this, arguments);
          };
        })(),
        y = (function () {
          var e = (0, a.Z)(
            i().mark(function e(n) {
              var t, r;
              return i().wrap(function (e) {
                for (;;)
                  switch ((e.prev = e.next)) {
                    case 0:
                      return (
                        "\n  mutation($username: String!){\n    forgetPassword(username: $username){\n      ok\n    }\n  }\n  ",
                        (t = (0, l.ZP)()),
                        (e.next = 4),
                        t
                          .request(
                            "\n  mutation($username: String!){\n    forgetPassword(username: $username){\n      ok\n    }\n  }\n  ",
                            n
                          )
                          .then(function (e) {
                            return { response: e };
                          })
                          .catch(function (e) {
                            return { error: e.response && e.response.errors };
                          })
                      );
                    case 4:
                      return (r = e.sent), e.abrupt("return", r);
                    case 6:
                    case "end":
                      return e.stop();
                  }
              }, e);
            })
          );
          return function (n) {
            return e.apply(this, arguments);
          };
        })(),
        x = (function () {
          var e = (0, a.Z)(
            i().mark(function e(n) {
              var t, r;
              return i().wrap(function (e) {
                for (;;)
                  switch ((e.prev = e.next)) {
                    case 0:
                      return (
                        "\n  mutation($username: String!){\n    resendAuth (username: $username){\n      ok\n    }\n  }\n  ",
                        (t = (0, l.ZP)()),
                        (e.next = 4),
                        t
                          .request(
                            "\n  mutation($username: String!){\n    resendAuth (username: $username){\n      ok\n    }\n  }\n  ",
                            n
                          )
                          .then(function (e) {
                            return { response: e };
                          })
                          .catch(function (e) {
                            return { error: e.response && e.response.errors };
                          })
                      );
                    case 4:
                      return (r = e.sent), e.abrupt("return", r);
                    case 6:
                    case "end":
                      return e.stop();
                  }
              }, e);
            })
          );
          return function (n) {
            return e.apply(this, arguments);
          };
        })();
    },
    68212: function (e, n, t) {
      (window.__NEXT_P = window.__NEXT_P || []).push([
        "/auth/signup",
        function () {
          return t(86989);
        },
      ]);
    },
    37437: function (e) {
      e.exports = {
        button: "Button_button__PjVhE",
        basic: "Button_basic__8vKgs",
        outline: "Button_outline__EsWgH",
        primary: "Button_primary___XGO6",
        custom: "Button_custom__35uVh",
        fullWidth: "Button_fullWidth__YGnCJ",
        loading: "Button_loading__sDdK_",
      };
    },
    35005: function (e) {
      e.exports = {
        container: "shared_auth_container__qG_A4",
        aside: "shared_auth_aside__ms1p1",
        content: "shared_auth_content__t2BiJ",
        asideTitle: "shared_auth_asideTitle__S1qBM",
        asideSubtitle: "shared_auth_asideSubtitle__BAQ1J",
        asideButton: "shared_auth_asideButton__Uh6HW",
        contentSubtitle: "shared_auth_contentSubtitle__8BDwx",
        contentTitle: "shared_auth_contentTitle__Iwznb",
        date: "shared_auth_date__H3di1",
        dateChild: "shared_auth_dateChild__eZyGa",
        dateStart: "shared_auth_dateStart__o_DR3",
        button: "shared_auth_button__6ykOn",
        toLoginButton: "shared_auth_toLoginButton__Y5Ikc",
        select: "shared_auth_select__hwDnl",
        forgotPasswordLabel: "shared_auth_forgotPasswordLabel__MFlaw",
        forgotPassword: "shared_auth_forgotPassword__6_ImN",
        logo: "shared_auth_logo____xWt",
        noResize: "shared_auth_noResize__1mJg5",
        fieldTrigger: "shared_auth_fieldTrigger___U9pP",
        radio: "shared_auth_radio__TDS9u",
        checkbox: "shared_auth_checkbox__CZs6e",
        passwordMeter: "shared_auth_passwordMeter__vfDuA",
        item: "shared_auth_item__bPv_M",
        quickNotice: "shared_auth_quickNotice__RLlal",
        quickNoticeBtn: "shared_auth_quickNoticeBtn__gTeZj",
        marginRight100: "shared_auth_marginRight100__XaQuO",
      };
    },
    41664: function (e, n, t) {
      e.exports = t(7942);
    },
  },
  function (e) {
    e.O(0, [9393, 1528, 3587, 7242, 8646, 9774, 2888, 179], function () {
      return (n = 68212), e((e.s = n));
      var n;
    });
    var n = e.O();
    _N_E = n;
  },
]);
