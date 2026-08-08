# Henry Harris's Website

Personal website for [henryharr.is](https://henryharr.is). The site is built as static HTML, CSS,
and JavaScript with Astro and deployed to Cloudflare Pages.

## Stack

| Concern | Choice |
|---|---|
| Framework | Astro 7, static output |
| Styling | Existing Sass design, compiled by Astro/Vite |
| Hosting | Cloudflare Pages project `my-website` |
| Node | 22.23.1 (pinned in `.nvmrc`) |
| CI | GitHub Actions build check on pushes and pull requests to `master` |
| Deploy | GitHub Actions, gated on publishing a GitHub Release |

The former PHP pages no longer require a PHP server. Interactive utilities run in the browser, API
demo responses are generated as static JSON, and legacy shortcut routes use Cloudflare redirects.

## Local development

```bash
nvm use
npm install
npm run dev
```

The development server runs at `http://localhost:4321`. Validate the production output with:

```bash
npm run build
npm run preview
```

## Deployment

Production deployments mirror the release-gated flow used by the wedding website:

- `.github/workflows/ci.yml` runs `npm ci` and `npm run build` on pushes and pull requests.
- `.github/workflows/deploy.yml` runs only when a GitHub Release is published and uploads `dist/`
  directly to Cloudflare Pages.
- Pushing to `master` does not deploy production.

The GitHub repository needs `CLOUDFLARE_API_TOKEN` and `CLOUDFLARE_ACCOUNT_ID` secrets. The API token
must be able to edit Cloudflare Pages projects in the account that owns `henryharr.is`.

Provision the Pages project once before the first release deploy:

```bash
npx wrangler login
npx wrangler pages project create my-website --production-branch=master
```

Then add `henryharr.is` as the project's custom domain in Cloudflare and mirror the wedding
repository's `CLOUDFLARE_API_TOKEN` and `CLOUDFLARE_ACCOUNT_ID` secrets into this repository.

To ship a verified commit, publish a GitHub Release for it and monitor the `Deploy` workflow.

Copyright 2016-2026, Henry Harris <mail@henryharr.is>
